<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" src="..\assets\css\style.css">
</head>
<body>
     <?php $this->load->view('partials/navbar'); ?>
    <div class="container">
        <h2>Login</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open('auth/login'); ?>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo set_value('email'); ?>">
            
            
            <label for="password">Password:</label>
            <input type="password" name="password">
            
            <input type="submit" value="Login">
        <?php echo form_close(); ?>
    </div>
</body>
</html>
