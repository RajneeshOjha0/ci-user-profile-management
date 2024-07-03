<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" src="..\assets\css\style.css">
</head>
<body>
     <?php $this->load->view('partials/navbar'); ?>
    <div class="container">
        <h2>Update Profile</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('dashboard/update_profile'); ?>
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo set_value('name', $user['name']); ?>">
            
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo set_value('email', $user['email']); ?>">
            
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" name="profile_picture">
            
            <input type="submit" value="Update Profile">
        <?php echo form_close(); ?>

        <h2>Update Password</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open('dashboard/update_password'); ?>
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password">
            
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password">
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password">
            
            <input type="submit" value="Update Password">
        <?php echo form_close(); ?>
    </div>
</body>
</html>
