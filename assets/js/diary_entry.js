// process diary entry form

document.addEventListener("DOMContentLoaded", () => {
    const userForm = document.getElementById("new_diary_entry_form");
    if (!userForm) return;
    userForm.addEventListener("submit", async function (e) {
        e.preventDefault();
        const text = document.getElementById("text").value.trim();
        if (!text) return alert("Diary Entry must not be empty!");
        try {
            const formData = new FormData(userForm);
            formData.append("text",text);
            console.log("formData new_diary_entry_form:");
            for (const pair of formData.entries()) {
                console.log(pair[0], "=", pair[1]);
            }
            const res = await fetch(`${BASE_URL}/api/diary_entry_insert.php`, {
                method: "POST", 
                body: formData 
            })
            const data = await res.json();
            console.log("Success/new_diary_entry_form: " + JSON.stringify(data));
            if (data.success) {
                userForm.reset();
                load_diary_entries(document.getElementById("filter").value);
            } else {
                alert("Error: " + (data.error || "Unknown error"));
            }
        }
        catch (err) {
            alert("Error: " + err.message);
        }
    });  // addEventListener submit
});  // addEventListener DOMContentLoaded

// create diary entry table

async function load_diary_entries(filter = "") {
    console.log('FILTER:' + filter)
    try {
        const res = await fetch(`${BASE_URL}/api/diary_entry_select.php?filter=${encodeURIComponent(filter)}`);
        entries = await res.json();
        console.log("Success/diary_entry_select: " + JSON.stringify(entries));
    }
    catch (err) {
        alert("Error: " + err.message);
        entries = [];
    }
    const tbody = document.getElementById("diary_entry_list");
    tbody.innerHTML = "";
    const template = document.getElementById("diary_entry_list_template");
    if (entries.length === 0) {
        const clone = template.content.cloneNode(true);
        const tr = clone.querySelector("tr");
        const cell = tr.querySelector(".date");
        cell.colSpan = 3;
        cell.textContent = "No entries found";
        cell.style.textAlign = "center";
        tr.querySelector(".text").remove();
        tr.querySelector(".actions").remove();
        tbody.appendChild(clone);
        return;
    }
    entries.forEach(e => {
        const clone = template.content.cloneNode(true);
        const tr = clone.querySelector("tr");
        tr.setAttribute('data-id', e.deid);
        tr.querySelector(".date").textContent = e.dedate;
        tr.querySelector(".text").textContent = e.detext;
        tr.querySelector(".saveBtn").addEventListener("click", async () => {
            const text = tr.querySelector(".text").textContent.trim();
            try {
                const formData = new FormData();
                formData.append("id",e.deid);
                formData.append("text",text);
                console.log("formData diary_entry_update:");
                for (const pair of formData.entries()) {
                    console.log(pair[0], "=", pair[1]);
                }
                const res = await fetch(`${BASE_URL}/api/diary_entry_update.php`, {method:"POST", body:formData});
                const data = await res.json();
                console.log("Success/diary_entry_update: " + JSON.stringify(data));
                if(!data.success) 
                    alert("Update Error: " + (data.error || "Unknown error"));
                load_diary_entries(document.getElementById("filter").value);
            }
            catch (err) {
                alert("Update Error: " + err.message);
            }
        }); // addEventListener click update
        tr.querySelector(".deleteBtn").addEventListener("click", async () => {
            if(!confirm("Delete this entry?")) return;
            const formData = new FormData();
            try {
                formData.append("id",e.deid);
                console.log("formData diary_entry_delete:");
                for (const pair of formData.entries()) {
                    console.log(pair[0], "=", pair[1]);
                }
                const res = await fetch(`${BASE_URL}/api/diary_entry_delete.php`, {method:"POST", body:formData});
                const data = await res.json();
                console.log("Success/diary_entry_delete: " + JSON.stringify(data));
                if(!data.success) 
                    alert("Delete Error: " + (data.error || "Unknown error"));
                load_diary_entries(document.getElementById("filter").value);
            }
            catch (err) {
                alert("Delete Error: " + err.message);
            }
        }); // addEventListener click delete
        tbody.appendChild(clone);
    });
} // load_diary_entries

document.getElementById("filter").addEventListener("input", e => {
    const filterValue = e.target.value.trim();
    load_diary_entries(filterValue);
});

document.getElementById("clearFilterBtn").addEventListener("click", e => {
    document.getElementById("filter").value = '';
    load_diary_entries();
});

load_diary_entries();
