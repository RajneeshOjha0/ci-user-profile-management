<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" src="..\assets\css\style.css">
</head>
<body>
     <?php $this->load->view('partials/navbar'); ?>
    <div class="container">
        <h2>Search Results</h2>
        <?php if (isset($results['hits']) && count($results['hits']) > 0): ?>
            <div class="search-results">
                <?php foreach ($results['hits'] as $result): ?>
                    <div class="search-result">
                        <img src="<?php echo $result['previewURL']; ?>" alt="<?php echo $result['tags']; ?>">
                        <p><?php echo $result['tags']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
