<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" src="..\assets\css\style.css">
</head>
<body>
     <?php $this->load->view('partials/navbar'); ?>
    <div class="container">
        <h2>Register</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open('auth/register'); ?>
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo set_value('name'); ?>">
            
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo set_value('email'); ?>">
            
            <label for="password">Password:</label>
            <input type="password" name="password">
            
            <input type="submit" value="Register">
        <?php echo form_close(); ?>
    </div>
</body>
</html>
