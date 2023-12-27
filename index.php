<?php
$connection = include_once "connection.php";
// all Notes 
$notes = $connection->getNotes();
//  Update Note 
$currentNote = [
    "id" => '',
    "title" => '',
    "description" => ''
];
if (isset($_GET["id"])) {
    $currentNote = $connection->getNoteById($_GET['id'])[0];
}
?>



<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>I note</title>
        <!-- custom css file -->

        <!-- add bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

        <!-- add fontawsome -->
        <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-6 mt-4">
                    <form action="save.php" class="text-center" method="post">
                        <input type="hidden" name="id" value="<?php echo $currentNote["id"] ?>">
                        <h1>Welcome To <span class="text-success ">I-Note</span></h1>
                        <div class="form-group">
                            <input type="text" placeholder="New  Note" name="title"
                              value="<?php echo $currentNote['title']; ?>" class="form-control" />
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description-text" cols="16" rows="10" class="form-control"
                              placeholder="Note Description"><?php echo $currentNote['description']; ?></textarea>
                        </div>
                        <button class="Add-note btn btn-success w-100">
                            <?php if ($currentNote["id"]): ?>
                                update note
                            <?php else: ?>
                                New Note
                            <?php endif ?>
                        </button>
                    </form>
                    <div class="notes p mt-3">
                        <?php foreach ($notes as $note): ?>
                            <div class="note bg-warning p-3 position-relative rounded mt-3">
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $note["id"] ?>">
                                    <button class="close btn bg-danger ">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </form>
                                <h4>
                                    <a class="text-dark" href="?id=<?php echo $note["id"] ?>">
                                        <?php echo $note["title"] ?>
                                    </a>
                                </h4>
                                <p>
                                    <?php echo $note["description"] ?>
                                </p>
                                <span class="position-absolute" style="right:20px; bottom:10px;">
                                    <?php echo $note["create_date"] ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- add bootstrap  -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>