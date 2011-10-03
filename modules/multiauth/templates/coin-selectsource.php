<?php
$this->data['header'] = $this->t('{multiauth:multiauth:select_source_header}');

$this->includeAtTemplateBase('includes/coin-header.php');
sort($this->data['sources']);
?>
<div class="column content">
    <div class="item">
        <span class="h2">Where do you want to log in?</span>
        <h3>Click a logo to use for logging in:</h3>
        
        <?php foreach ($this->data['sources'] as $source): ?>
        <p>
            <a href="?source=<?php echo urlencode($source);?>&AuthState=<?php echo urlencode($this->data['authstate']);?>">
                <img src="/resources/logos/<?php echo $source; ?>-logo.png" alt="<?php echo $source; ?>" />
            </a>
        </p>
        <?php endforeach;?>

<?php $this->includeAtTemplateBase('includes/coin-footer.php'); ?>

