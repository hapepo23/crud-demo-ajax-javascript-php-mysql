<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Little Diary</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1>My Little Diary</h1>

<h2>New Entry</h2>
<form id="new_diary_entry_form">
    <textarea id="text"></textarea>
    <button type="submit">💾 Create New Entry</button>
</form>

<h2>Diary Entries</h2>

<div id="filterdiv">
<label for="filter">Filter: </label>
<input type="text" id="filter">
<button id="clearFilterBtn">❌</button>
</div>

<table border="1">
    <thead>
        <tr><th>Date/Time</th><th>Entry (Click to update)</th><th>Actions</th></tr>
    </thead>
    <tbody id="diary_entry_list"></tbody>
</table>

<!-- Template for Entry Rows -->
<template id="diary_entry_list_template">
    <tr data-id="">
        <td class="date"></td>
        <td class="text" contenteditable="true"></td>
        <td class="actions">
            <button class="saveBtn">💾</button>
            <button class="deleteBtn">❌</button>
        </td>
    </tr>
</template>

<!-- JavaScript -->
<script>
const BASE_URL = "/diary"; // <--- This may need to be changed.
</script>
<script src="config/debugging.js"></script>
<script src="assets/js/diary_entry.js"></script>

</body>
</html>
