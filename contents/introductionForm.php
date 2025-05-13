<?php

$fullName = 'Brenda Oliveira';
$profilePicture = 'images/brendas.png';
$caption = 'Coffee time to survive this life';
$personalBackground = 'Born and raised in the north of Brazil, I moved to the US in 2020.';
$professionalBackground = 'In my country, I worked as an English teacher in high school, as a computer instructor (Microsoft Office), and as a coordinator for a social assistance reference center. Last Fall semester 2024 I worked as a Service Desk Intern at CPCC.';
$academicBackground = ' I graduated in Brazil with a degree in English Literature, and now I am pursuing Information Technology: Full Stack Programming and Cloud & Virtualization Tech.';
$backgroundSubject = 'I took Web110, CTI110, and Web115.';
$primaryPlatform = 'MacBook Air M1, 2020';
$funnyItem = 'I like to read Mangas and watch Anime.';
$courses = [
    ['name' => 'CSC154 – Software Development', 'reason' => 'Important for graduation.'],
    ['name' => 'CTS240 – Project Management', 'reason' => 'Most of my courses this semester are essential for completing my AAS - Full Stack Programming'],
    ['name' => 'NET126 – Switching and Routing', 'reason' => 'Part of my major in Cloud & Virtualization Tech.'],
    ['name' => 'CTS118 – IS Professional Communication', 'reason' => 'Essential for non-native speakers to build vocabulary.'],
    ['name' => 'WEB250 – Database Driven Websites', 'reason' => 'It is part of my Web Developer path.'],
    ['name' => 'WEB215 – Advanced Markup & Scripting', 'reason' => 'Helps me become a Web Developer.'],
];

$showIntro = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'] ?? $fullName;
    $profilePicture = $_POST['profilePicture'] ?? $profilePicture;
    $caption = $_POST['caption'] ?? $caption;
    $personalBackground = $_POST['personalBackground'] ?? $personalBackground;
    $professionalBackground = $_POST['professionalBackground'] ?? $professionalBackground;
    $academicBackground = $_POST['academicBackground'] ?? $academicBackground;
    $backgroundSubject = $_POST['backgroundSubject'] ?? $backgroundSubject;
    $primaryPlatform = $_POST['primaryPlatform'] ?? $primaryPlatform;
    $funnyItem = $_POST['funnyItem'] ?? $funnyItem;
    $courses = $_POST['courses'] ?? $courses;

    $showIntro = ($_POST['mode'] ?? '') === 'intro';

if (isset($_FILES['uploadPicture']) && $_FILES['uploadPicture']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    $tmpPath = $_FILES['uploadPicture']['tmp_name'];
    $fileName = $_FILES['uploadPicture']['name'];
    $fileType = mime_content_type($tmpPath);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (in_array($fileType, $allowedTypes)) {
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $safeName = uniqid('img_', true) . '.' . $ext;
        $destPath = $uploadDir . $safeName;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($tmpPath, $destPath)) {
            $profilePicture = $destPath;
        } else {
            $uploadError = "Failed to save uploaded file.";
        }
    } else {
        $uploadError = "Invalid image type.";
    }
}


}
?>

<?php if (!$showIntro): ?>
<h2>Introduction Form</h2>
<form method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullName" value="<?= htmlspecialchars($fullName) ?>">
  </div>

  <div class="form-group">
    <label for="profilePicture">Profile Picture URL:</label>
    <input type="text" id="profilePicture" name="profilePicture" value="<?= htmlspecialchars($profilePicture) ?>">

    <label for="uploadPicture">Or Upload Picture:</label>
    <input type="file" id="uploadPicture" name="uploadPicture" accept="image/*">
  </div>
    <?php if (!empty($uploadError)): ?>
        <p class="error" style="color: red;"><?= htmlspecialchars($uploadError) ?></p>
    <?php endif; ?>

  <div class="form-group">
    <label for="personalBackground">Personal Background:</label>
    <textarea id="personalBackground" name="personalBackground"><?= htmlspecialchars($personalBackground) ?></textarea>
  </div>

  <div class="form-group">
    <label for="professionalBackground">Professional Background:</label>
    <textarea id="professionalBackground" name="professionalBackground"><?= htmlspecialchars($professionalBackground) ?></textarea>
  </div>

  <div class="form-group">
    <label for="academicBackground">Academic Background:</label>
    <textarea id="academicBackground" name="academicBackground"><?= htmlspecialchars($academicBackground) ?></textarea>
  </div>

  <div class="form-group">
    <label for="backgroundSubject">Background in this Subject:</label>
    <textarea id="backgroundSubject" name="backgroundSubject"><?= htmlspecialchars($backgroundSubject) ?></textarea>
  </div>

  <div class="form-group">
    <label for="primaryPlatform">Primary Computer Platform:</label>
    <input type="text" id="primaryPlatform" name="primaryPlatform" value="<?= htmlspecialchars($primaryPlatform) ?>">
  </div>

  <div class="form-group">
    <label for="funnyItem">Funny/Interesting Thing to Remember Me By:</label>
    <textarea id="funnyItem" name="funnyItem"><?= htmlspecialchars($funnyItem) ?></textarea>
  </div>


  <h3>Courses I'm Taking &amp; Why:</h3>
  <?php foreach ($courses as $index => $course): ?>
    <div class="course-group">
      <label for="course<?= $index ?>">Course Name:</label>
      <input type="text" id="course<?= $index ?>" name="courses[<?= $index ?>][name]" value="<?= htmlspecialchars($course['name']) ?>" placeholder="Course title" />

      <label for="reason<?= $index ?>">Reason:</label>
      <textarea id="reason<?= $index ?>" name="courses[<?= $index ?>][reason]"><?= htmlspecialchars($course['reason']) ?></textarea>
    </div>
  <?php endforeach; ?>

  <input type="hidden" name="mode" value="intro">
  <button type="submit">Generate</button>
</form>
<?php else: ?>


<h2>Introduction</h2>

<figure>
  <img src="<?= htmlspecialchars($profilePicture) ?>" alt="Profile Picture" style="max-width: 500px; max-height: 500px; object-fit: contain;">
  <figcaption><?= htmlspecialchars($caption) ?></figcaption>
</figure>


<ul>
  <li><strong>Personal background:</strong> <?= htmlspecialchars($personalBackground) ?></li>
  <li><strong>Professional background:</strong> <?= htmlspecialchars($professionalBackground) ?></li>
  <li><strong>Academic background:</strong> <?= htmlspecialchars($academicBackground) ?></li>
  <li><strong>Background in this subject:</strong> <?= htmlspecialchars($backgroundSubject) ?></li>
  <li><strong>Primary Computer Platform:</strong> <?= htmlspecialchars($primaryPlatform) ?></li>
  <li><strong>Courses I'm Taking & Why:</strong>
    <ul>
      <?php foreach ($courses as $course): ?>
        <li><strong><?= htmlspecialchars($course['name']) ?>:</strong> <?= htmlspecialchars($course['reason']) ?></li>
      <?php endforeach; ?>
    </ul>
  </li>
  <li><strong>Funny/Interesting Item to Remember Me By:</strong> <?= htmlspecialchars($funnyItem) ?></li>
</ul>

<form method="POST">
  <input type="hidden" name="mode" value="edit">
  <button type="submit">Back to Edit</button>
</form>

<?php endif; ?>