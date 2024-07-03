<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" src="..\assets\css\style.css">
</head>
<body>
     <?php $this->load->view('partials/navbar'); ?>
    <div class="container">
        <h2>Search</h2>
        <?php echo form_open('search/search_pixabay'); ?>
            <label for="query">Search:</label>
            <input type="text" name="query" value="">
            
            <input type="submit" value="Search">
        <?php echo form_close(); ?>
    </div>
</body>
</html>
