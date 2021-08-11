<?php

session_start();
ob_start();
$db_location = "../src/db/db.php";
$notesTableName = "notes";

include($db_location);
$conn = new dbProcess();

$userId = $_SESSION['userId'];

$db = $conn->connDB();
$query = $db->query("SELECT * FROM {$notesTableName} WHERE noteOwner = '$userId' ORDER BY noteId DESC ", PDO::FETCH_ASSOC);
$queryCount = $query->rowCount();
$notes = array();
$count = 1;

foreach ($query as $row) {

?>

<!--
\\\START///
Note content here, the number and text is shown here. -->
<div class="note-block row">
    <div class="notes100-number col-1 fs-30 d-flex align-items-center">
        <?php echo $count; ?>
    </div>
    <div class="notes100 col-9">
        <?php echo $row['noteTitle']; ?>
    </div>
    <div class="fs-30 col-2 d-flex align-items-center">
        
        <button 
        class="noteDetailsButton"
        data-bs-toggle="modal" 
        data-bs-target="#noteDetailModal" 
        noteDetailsID="<?php echo $row['noteId']; ?>"
        noteDetailsOwner="<?php echo $row['noteOwner']; ?>"
        noteDetailsTitle="<?php echo $row['noteTitle']; ?>"
        noteDetailsContent="<?php echo $row['noteContent']; ?>"
        noteDetailsDate="<?php echo $row['noteDate']; ?>">
            
            <i class="fa fa-superpowers" aria-hidden="true"></i>
        
        </button>

    </div>
</div>
<!-- \\\FINISH/// -->

<?php
$count++;

if($count <= $queryCount):

?>
<!-- Note Divider Start -->
<div class="row py-2">
    <div class="notes100-divider"></div>
</div>
<!-- Note Divider Finish -->
<?php
endif;

}
?>


