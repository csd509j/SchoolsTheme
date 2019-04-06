<script async src="https://www.googletagmanager.com/gtag/js?id=<?php the_field('tracking_code', 'options');?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php the_field('tracking_code', 'options');?>');
</script>
