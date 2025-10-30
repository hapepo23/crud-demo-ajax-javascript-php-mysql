<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Little Diary</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1>My Diary</h1>

<h2>New Entry</h2>
<form id="new_diary_entry_form">
    <textarea id="text"></textarea>
    <button type="submit">💾 Create New Entry</button>
</form>

<h2>Diary Entries</h2>
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

<script>
const BASE_URL = "http://localhost/diary"; 
</script>
<script src="assets/js/diary_entry.js"></script>

</body>
</html>
