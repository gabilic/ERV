<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo Strings::APP_NAME; ?></title>
    <link rel="stylesheet" href="../resources/css/design.css">
    <?php echo ($table_design ? "<link rel=\"stylesheet\" href=\"../resources/css/table.css\">" : ""); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php echo ($table_design ? "<script src=\"../resources/js/table_builder.js\"></script>" : ""); ?>
  </head>
  <body>
    <header class="header-style">
      <div class="centered">
        <div>
          <h1 class="site-title"><?php echo Strings::APP_NAME; ?></h1>
        </div>
      </div>
    </header>
    <main>
      <div class="centered">
        <section class="section-content">
          <article class="card">
