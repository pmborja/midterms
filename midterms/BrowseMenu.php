<!DOCTYPE html>
<html>
<head>
    <link href="home.html" rel="stylesheet">
    <link href="Contact.html" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Menu</title>

    <style>

        body{
            background-image: url("logo_vert.png");
            background-repeat: no-repeat;
            background-position: left;
            background-attachment: fixed;
            background-size: 35vh;
        }

        .click{
            margin: 30px;
            font-family: 'Quicksand';
            text-align: center;
            font-size: 23px;
            color: white;
        }

        a:link, a:visited{
            background-color:  rgb(248, 148, 169);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
        }

        a:hover, a:active {
            color: white;
            background-color: rgb(11, 199, 11);
        }

        table 
        {
            width: 100%;
            font-family: 'Quicksand';
            font-size: 20px;
        }
        table, th, td 
        {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: center;
        }

        input[type='button'] 
        {
            font-family: 'Quicksand';
            font-size: 20px;
            cursor: pointer;
            border: none;
            color: #FFF;
        }
        
        input[type='text'], select 
        {
            font-family: 'Quicksand';
            font-size: 20px;
            text-align: center;
            border: solid 1px #CCC;
            width: auto;
            padding: 2px 3px;
        }

        .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited, .btn-info, .btn-info:hover, .btn-info:active, .btn-info:visited {
            background-color: rgb(11, 199, 11); !important;
        }

        .form-control{
            font-family: 'Quicksand';
            font-size: 20px;
        }
    </style>
</head>
<body style="background-color: rgb(245, 250, 217);">

    <div class="container mt-2 mb-4 p-2 shadow bg-white">
        <form action="process.php" method="POST">
            <div class="form-row justify-content-center">
                <div class="col-auto">
                    <input type="text" name="product_name" class="form-control" id="product_name">
                </div>
                
                <div class="col-auto">
                    <input type="text" name="price" class="form-control" id="price">
                </div>
                <div class="col-auto">
                    <button type="submit" name="save" class="btn btn-info">Save</button>
                </div>
            </div>
        </form>
    </div>

    <?php require_once("process.php"); ?>

    <div class="container">
        <?php if(isset($_SESSION['msg'])): ?>
            <div class="<?= $_SESSION['alert']; ?>">
                <?= $_SESSION['msg'];
                unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <form action="process.php" method="POST">
                    <?php
                        $sQuery = "SELECT * FROM data";
                        $result = $conn->query($sQuery);

                        $x = 1;

                        while($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['product_name']; ?></td>
                            
                            <td><?= $row['price']; ?></td>
                            <td style="width: 15%">
                                <button type="submit" name="edit" value="<?= $x; $x++;?>" class="btn btn-primary">Edit</button>
                                <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </form>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script type="text/javascript">
            $(document).ready(function(){
                setTimeout(function(){
                    $(".alert").remove();
                }, 2000);

                $(".btn-primary").click(function(){
                    $(".table").find('tr').eq(this.value).each(function(){
                        $("#product_name").val($(this).find('td').eq(1).text());
                        $("#price").val($(this).find('td').eq(2).text());
                        $("#.btn-info").val($(this).find('td').eq(0).text());
                    });
                    $(".btn-info").attr("name", "edit");
                });
            });
    </script>

    <div id="container" style="width:1000px; margin-left: 290px; margin-top: 50px;">
    </div>
    <div class="click">
        <a style="text-decoration:none; color:white" href="home.html">HOME</a><br><br>
        <a style="text-decoration:none; color:white" href="Contact.html">CONTACT US!</a>
    </div>
</body>
</html>