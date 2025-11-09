<?php
require_once __DIR__ . '/../JsonHelper.php';
require 'member.php';
$dataFile = __DIR__ . '/../../data/team.json';

// original name from query - this identifies which member we're editing
$originalName = $_GET['name'] ?? '';
if ($originalName === '') {
    die("Member name is required.");
}

// load member
$member = JsonHelper::findByField($dataFile, 'name', $originalName);
if (!$member) {
    die("Member not found.");
}

$member = new Member($member['name'], $member['title'], $member['background']);

$errors = [];

// Pre-fill form values
$nameVal = $member->name ?? '';
$titleVal = $member->title ?? '';
$backgroundVal = $member->background ?? '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prefer the hidden original_name if present (safer), otherwise fall back to query param
    $original_name_hidden = trim((string)($_POST['original_name'] ?? $originalName));

    $nameVal = trim((string)($_POST['name'] ?? ''));
    $titleVal = trim((string)($_POST['title'] ?? ''));
    $backgroundVal = trim((string)($_POST['background'] ?? ''));

    // Validation
    if ($nameVal === '') $errors[] = "Name is required.";
    if ($titleVal === '') $errors[] = "Title is required.";
    if ($backgroundVal === '') $errors[] = "Background is required.";

    // If renaming, ensure the new name is not already used by another name
    if (empty($errors) && $nameVal !== $original_name_hidden) {
        $existing = JsonHelper::findByField($dataFile, 'name', $nameVal);
        if ($existing !== null) {
            $errors[] = "Another name with that name already exists.";
        }
    }
    
    if (empty($errors)) {
        $newMember = new Member($nameVal, $titleVal, $backgroundVal);
        $newData = $newMember->returnAsArray();

        $updated = JsonHelper::updateByField($dataFile, 'name', $original_name_hidden, $newData);
        if ($updated === null) {
            $errors[] = "Failed to update (item not found while saving).";
        } else {
            // Redirect to the detail page for the (possibly renamed) member
            header('Location: detail.php?name=' . urlencode($nameVal));
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">Edit member "<?php echo htmlspecialchars($member->name); ?>"</h2>

  <?php if ($errors): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $err): ?>
                <li><?php echo htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
  <?php endif; ?>

  <form method="POST" class="mx-auto" style="max-width: 600px;">
      <input type="hidden" name="original_name" value="<?php echo htmlspecialchars($member->name); ?>">

      <div class="mb-3">
        <label class="form-label">Member Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($member->name); ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Title</label>
        <textarea name="title" class="form-control" rows="1" required><?php echo htmlspecialchars($member->title); ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Background</label>
        <textarea name="background" class="form-control" rows="3" required><?php echo htmlspecialchars($member->background); ?></textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-success me-2">Save Changes</button>
        <a href="detail.php?name=<?php echo urlencode($member->name); ?>" class="btn btn-secondary">Cancel</a>
      </div>
  </form>
</div>
</body>
</html>
