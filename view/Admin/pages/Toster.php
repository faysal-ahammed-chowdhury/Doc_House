<?php if(isset($_SESSION['toster'])): ?>
    <div id="toster-data" data-message="<?= htmlspecialchars($_SESSION['toster']['message']); ?>"></div>
<?php unset($_SESSION['toster']); ?>
