<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'graveguard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch combined data
$sql = "
SELECT 
    g.grave_id, 
    g.grave_type, 
    p.plot_number, 
    p.plot_description, 
    CONCAT(d.deadpp_fname, ' ', d.deadpp_mname, ' ', d.deadpp_lname) AS deceased_name, 
    d.deadpp_gender AS gender, 
    d.deadpp_bdate AS birth_date, 
    d.deadpp_ddate AS death_date, 
    d.deadpp_rep AS representative, 
    d.deadpp_conNum AS contact_number, 
    b.brgy_name AS barangay, 
    g.grave_burried AS date_buried, 
    g.grave_xpire AS grave_expiry, 
    g.grave_fee AS grave_fee
FROM grave_tbl g
LEFT JOIN plot_tbl p ON g.plot_id = p.plot_id
LEFT JOIN deadpp_tbl d ON g.deadpp_id = d.deadpp_id
LEFT JOIN brgy_tbl b ON d.brgy_id = b.brgy_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
echo "
<tr>
    <td>{$row['grave_id']}</td>
    <td>{$row['grave_type']}</td>
    <td>{$row['plot_number']}</td>
    <td>{$row['plot_description']}</td>
    <td>{$row['deceased_name']}</td>
    <td>{$row['gender']}</td>
    <td>{$row['birth_date']}</td>
    <td>{$row['death_date']}</td>
    <td>{$row['representative']}</td>
    <td>{$row['contact_number']}</td>
    <td>{$row['barangay']}</td>
    <td>{$row['date_buried']}</td>
    <td>{$row['grave_expiry']}</td>
    <td>{$row['grave_fee']}</td>
    <td>
        <button 
            class='btn btn-sm btn-primary' 
            data-bs-toggle='modal' 
            data-bs-target='#editModal' 
            onclick='populateEditModal({
                grave_id: \"{$row['grave_id']}\",
                grave_type: \"{$row['grave_type']}\",
                plot_number: \"{$row['plot_number']}\",
                plot_description: \"{$row['plot_description']}\",
                deceased_fname: \"{$row['deceased_name']}\",
                gender: \"{$row['gender']}\",
                birth_date: \"{$row['birth_date']}\",
                death_date: \"{$row['death_date']}\",
                representative: \"{$row['representative']}\",
                contact_number: \"{$row['contact_number']}\",
                barangay: \"{$row['barangay']}\",
                date_buried: \"{$row['date_buried']}\",
                grave_expiry: \"{$row['grave_expiry']}\",
                grave_fee: \"{$row['grave_fee']}\"
            })'>Edit</button>
            <button 
        class='btn btn-sm btn-danger' 
        data-bs-toggle='modal' 
        data-bs-target='#deleteModal' 
        onclick='populateDeleteModal({$row['grave_id']})'>Delete</button>
    </td>
</tr>";
    }
}

$conn->close();
?>
