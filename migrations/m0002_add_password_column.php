<?php
/**
 * User: k7brasil
 * Date: 30/07/2022
 * Time: 8:43 PM
 */
class m0002_add_password_column {
    public function up()
    {
        $db = \k7brasil\microphp\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
    }

    public function down()
    {
        $db = \k7brasil\microphp\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
    }
}