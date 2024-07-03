<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" src="..\assets\css\style.css">
</head>
<body>
     <?php $this->load->view('partials/navbar'); ?>
    <div class="container">
        <h2>Welcome, <?php echo $name; ?>!</h2>
        <?php if ($profile_picture): ?>
            <img class="profile-picture" src="<?php echo base_url('uploads/' . $profile_picture); ?>" alt="Profile Picture">
        <?php endif; ?>
        <nav>
            <ul>
                <li><a href="<?php echo site_url('dashboard'); ?>">Dashboard</a></li>
                <li><a href="<?php echo site_url('dashboard/profile'); ?>">Profile</a></li>
                <li><a href="<?php echo site_url('search'); ?>">Search</a></li>
                <li><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
