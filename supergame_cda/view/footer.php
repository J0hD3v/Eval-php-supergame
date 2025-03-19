<?php

class ViewFooter {

    public function displayView(): string {
        ob_start();
        ?>
                        </main>
            <footer>

            </footer>
        </body>
        </html>

        <?php

        return ob_get_clean();
    }
}