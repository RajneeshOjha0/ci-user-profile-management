<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        ul{
            list-style: none;
            padding: 0;
            margin:0;
            display: flex;
            align-items: start;
        }
        li{
            margin-right:10px;
        }
        .navbar{
            background-color:grey;
        }
    </style>
</head>
<body>
    <div class="navbar">
    <div class="container">
        <?php if ($this->session->userdata('logged_in')): ?>
            <ul>
                <li><a href="<?php echo site_url('dashboard'); ?>">Dashboard</a></li>
                <li><a href="<?php echo site_url('dashboard/profile'); ?>">Profile</a></li>
                <li><a href="<?php echo site_url('search'); ?>">Search</a></li>
                <li><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>

                <li> <a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
                <li><a href="<?php echo site_url('auth/logout'); ?>">Logout</a> </li>
                 
        <?php else: ?>
            <a href="<?php echo site_url('auth/login'); ?>">Login</a>
            <a href="<?php echo site_url('auth/register'); ?>">Register</a>
        <?php endif; ?>
                
            </ul>
            
            
      
           
    </div>
</div>

    
</body>
</html>