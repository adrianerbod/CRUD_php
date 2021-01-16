<?php require_once "process.php"; ?>

<!DOCTYPE html>
<html lang="en" dir='ltr'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <title>Budget App</title>
    <link rel='stylesheet' href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
</head>

<body>
    <!--NAV-->
    <nav class="navbar_container">
        <div class="navbar_wrapper">
            <span class="logo"><a href="index.php" class='logoText'><i class="fas fa-dice-d20"></i> Logo</a></span>
            <?php if ($update == true) : ?>
                <button class="createData">Update Expense</button>
            <?php else : ?>
                <button class="createData">Add Expense</button>
            <?php endif; ?>
        </div>
    </nav>
    <!--!-NAV-->

    <!--Total-->
    <h2 class="total">Total: $ <?php echo $total; ?></h2>
    <!--!-Total-->

    <!--Table-->
    <div class="bigLebowski">
        <table class='table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th colspan='2'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resault = mysqli_query($conn, "SELECT * FROM budget");
                while ($row = $resault->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo ucfirst($row['budget_name']); ?></td>
                        <td><?php echo ucfirst($row['budget_amount']); ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['budget_id']; ?>" class='btnEdit'><i class="fas fa-edit"></i></a>
                            <a href="process.php?delete=<?php echo $row['budget_id']; ?>" class='btnDelete'><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
    <!--!-Table-->

    <!--Popup-->
    <div class="popUp">
        <div class="popCard">
            <h2 class="popTitle">Add Expenses</h2>
            <form action="process.php" method="POST">
                <div class="form-group">
                    <input type="hidden" name='id' value='<?php echo $id; ?>'>
                    <input type="text" name="name" class='formControl' id="budgetTitle" placeholder="Name" required autocomplete="off" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="amount" id="amount" placeholder="Amount" required autocomplete="off" value="<?php echo $amount; ?>">
                </div>
                <?php if ($update == true) : ?>
                    <button type="submit" name="update" class='btn btnUpdate'>Update</button>
                <?php else : ?>
                    <button type="submit" name="save" class='btn'>Save</button>
                <?php endif ?>
            </form>
            <button class='closePop'>X</button>
        </div>
    </div>
    <!--!-Popup-->

    <!--JS-->
    <script>
        const popUp = document.querySelector('.popUp');
        document.querySelector('.createData').addEventListener('click', () => {
            popUp.classList.add('show');
        })
        document.querySelector('.closePop').addEventListener('click', () => {
            popUp.classList.remove('show');
        });
    </script>
    <!--!-JS-->
</body>

</html>