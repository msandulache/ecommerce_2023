<?php
require_once "../vendor/autoload.php";
include_once '../config/config.php';
include_once '../includes/header.php';

$faker = Faker\Factory::create('ro_RO');

for ($i = 0; $i < 2; $i++) {

//    $sql = sprintf("INSERT INTO users(username, email, mypassword, created_at) VALUES('%s', '%s', '%s', '%s')",
//        $faker->name(),
//        $faker->email(),
//        password_hash($faker->password(),PASSWORD_DEFAULT),
//        date('Y-m-d H:i:s')
//    );

    $sql = sprintf("INSERT INTO categories(name, description, image, created_at) VALUES('%s', '%s', '%s', '%s')",
        ucfirst($faker->word()),
        ucfirst($faker->text(100)),
        $faker->image('/var/www/html/images', 640, 480),
        date('Y-m-d H:i:s')
    );

    $conn->query($sql);
}

echo "Fake entries inserted successfully.";

?>

<?php include_once '../includes/footer.php'; ?>