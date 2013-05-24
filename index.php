<?php

function processNine($str)
{
  global $maxIcon;

  $values = array();
  $ptr = strrpos($str, '9');
  $stack = str_split($str);

  if ($ptr !== false)
  {
    foreach (range("A", "E") as $hex) 
    {
      $stack[$ptr] = $hex;
      $values[] = implode("", $stack);
      if (implode("", $stack) == $maxIcon) break;
      $values = array_merge($values, processNine(implode("", $stack)));
    }
  }

  return $values;
}

$values = array();
$maxIcon = "17C";

foreach(range(0, 179) as $n)
{
  $n = sprintf('%03d', $n);
  $values[] = $n;
  $values = array_merge($values, processNine($n));
}

$values = array_unique($values);

?>

<html>
<head>
  <title></title>
  <style>

<?php ob_start(); ?>
@font-face{
  font-family:Batch;
  src:url('batch-icons-webfont.eot');
  src:url('batch-icons-webfont.eot?#iefix') format('embedded-opentype'),
    url('batch-icons-webfont.woff') format('woff'),
    url('batch-icons-webfont.ttf') format('truetype'),
    url('batch-icons-webfont.svg#batchregular') format('svg');
  font-weight:normal;
  font-style:normal;
}

.batch {
  font-family: "Batch";
  line-height:1;
  display:inline-block;
  -webkit-font-smoothing: antialiased;
}

.batch:before {
  content:attr(data-icon);
}

.batch-large { font-size:32px; }
.batch-huge { font-size:64px; }
.batch-natural { font-size:inherit; }

<?php foreach($values as $icon) {
  echo ".batch.uniF".$icon.":before{content:\"\F{$icon}\";}\r\n";
} ?>

<?php $css = ob_get_contents(); ?>
<?php ob_get_clean(); ?>

<?php echo $css; ?>

    body { 
      font-family: "Consolas"; 
      background: #ccc;
      margin: 0px;
      padding: 0px;
    }

    .placeholder {
      border: 1px solid #efefef;
      background: #fff;
      box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
      border-radius: 3px;
    }

    .placeholder { 
      font-weight: normal; 
      text-align: center;
    }

    .placeholder .batch {
      padding: 15px;
    }

    .placeholder label {
      display: block;
      background: #efefef;
      padding: 3px 15px;
    }

    .usage {
      border-top: 10px solid #999;
      display: block;
      clear: both;
      background: #fff;
      margin-top: 20px;
      padding: 30px;
    }

    .usage textarea {
      resize: none;
      width: 100%;
      height: 200px;
      border: 0px;
      background: #fafafa;
      outline: none;
    }

    .clearfix {
      display: block;
      clear: both;
    }

    h3 {
      margin: 10px 0px 25px;
      border-bottom: 1px solid #ccc;
    }

    code {
      background: #fafafa;
      border: 1px solid #efefef;
      display: block;
      padding: 20px;
      margin: 15px;
    }

  </style>
</head>
<body>
  <?php ob_start(); ?>
  <?php foreach($values as $icon): ?>
    <div style="float:left;margin:10px;">
      <!-- <div class="placeholder">
        <div class="batch" data-icon="<?php echo '&#xF'.$icon; ?>;"></div>&nbsp;<?php echo $icon; ?>
      </div> OR -->
      <div class="placeholder">
        <div class="batch batch-large <?php echo 'uniF'.$icon; ?>"></div>
        <label><?php echo $icon; ?></label>
      </div>
    </div>
  <?php endforeach; ?>
  <?php echo ob_get_clean(); ?>
  
  <div class="clearfix"></div>

  <div class="usage">
    <h3>Batch Webfont v1.3</h3>
    <a href="http://adamwhitcroft.com/batch/">Batch Homepage</a><br/>
    <a href="https://github.com/AdamWhitcroft/Batch/">Batch Github</a>
    <br/>
    <br/>
    <br/>

    <h3>Usage:</h3>
    
    <code>
      &lt;div class="batch" data-icon="&amp;#xF0D7;">&lt;/div> Database
    </code>
    <code>
      &lt;div class="batch uniF0D7">&lt;/div> Database
    </code>

    <h3>CSS:</h3>
    
    <code>
      <textarea readonly><?php echo $css; ?></textarea>
    </code>
    <br/>
    <br/>

    <h3>CSS Modifiers:</h3>

    <code>
      <div class="batch batch-large uniF0D7"></div>

      .batch-large { font-size:32px; }
    </code>
    <code>
      <div class="batch batch-huge uniF0D7"></div>

      .batch-huge { font-size:64px; }
    </code>
    
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

    Brought to you by: khebs (:

  </div>
</body>
</html>