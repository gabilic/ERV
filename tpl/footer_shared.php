          </article>
        </section>
      </div>
    </main>
    <?php echo ($time_calculator ? "<script src=\"../resources/js/time_calculator.js\"></script>" : ""); ?>
    <?php echo (isset($script) && !empty($script) ? "<script src=\"../resources/js/{$script}\"></script>" : ""); ?>
  </body>
</html>
