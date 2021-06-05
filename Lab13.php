<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- 
        Name: Associate Professor Hong Cui
        Balckboard User Names: lballoni, jjloree, hsimmons, kkaaihue
        Filename: Lab13_form.html
        Class Section: CTI.110.0001
        Purpose: Group Project L13
        -->
    <meta charset="utf-8"/>
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Lab13.css" type="text/css">
    <title>L13 Concert Event</title>
    </head>
    <body>
        <header>
            <h1>Concert Ticket Order Summary</h1>
        </header>
        <main>
            <section class="order_summary">
                
                <?php
               $name = $_POST['fullname'];
               $phone = $_POST['phone'];
               $adultTickets = $_POST['adult_ticket'];
               $childTickets = $_POST['child_ticket'];
               $location = $_POST['location'];
               $date = $_POST['date'];
               $subtotal = $adultTickets * 35 + $childTickets * 30;
               $salesTax = $subtotal * 0.07;
               $additionalCost = $adultTickets + $childTickets;
               $maxFee = $additionalCost * 1.00;
               $minFee = $additionalCost * 0.50;
                   if ($additionalCost <= 5) {
                      $additionalCost = $maxFee;
                   } else {
                       $additionalCost = $minFee;
                   }
               $totalCost = $subtotal + $salesTax + $additionalCost; 

               print("<p>Name: $name</p>");
               print("<p>Phone Number: $phone</p>");
               print("<p>Adult tickets: $adultTickets</p>");
               print("<p>Child tickets: $childTickets</p>");
               print("<p>Location: $location</p>");
               print("<p>Date: $date<p>");
               print("<p>Subtotal: $".number_format($subtotal,2)."</p>");
               print("<p>Tax: $".number_format($salesTax,2)."</p>");
               print("<p>Total Cost: $".number_format($totalCost,2)."</p>"); 
               
               $server = "localhost";
               $user = "cti110";
               $pw = "wtcc";
               $db = "mydatabase";
               $connect=mysqli_connect($server, $user, $pw, $db);
               if( !$connect) 
               {
                   die("ERROR: Cannot connect to database $db on server $server 
                   using user name $user (".mysqli_connect_errno().
                   ", ".mysqli_connect_error().")");
               }
               $userQuery = "SELECT firstName, lastName FROM personnel WHERE jobTitle='Manager'";
               $result = mysqli_query($connect, $userQuery);
               if (!$result) 
               {
                   die("Could not successfully run query ($userQuery) from $db: " .    
                       mysqli_error($connect) );
               }
               if (mysqli_num_rows($result) == 0) 
               {
                   print("No records found with query $userQuery");
               }
               else 
               { 
                   print("<p>Please contact the manager if you have question:</p>");

                   while ($row = mysqli_fetch_assoc($result))
           {
               print ("<p>" .$row['firstName']." ".$row['lastName']."</p>");
           }
       }
       mysqli_close($connect);  
       
               print("<p>Thanks $name for using this program!</p>");
                ?>

            </section>
        </main>
        <footer>
            <a href="Lab13_main.html">Return to Main Page</a>
        </footer>
    </body>
    
</html>