<?php if(!class_exists("View", false)) exit("no direct access allowed");?><?php if (!empty($GLOBALS['cfg']['visitor_stats'])) : ?>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/stats.js"></script>
<?php endif; ?>