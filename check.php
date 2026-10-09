<?php
ob_start();
session_start();
include "config.php";

$_SESSION['check_visits'] = ($_SESSION['check_visits'] ?? 0) + 1;

$rows = [];
function add(&$rows, $label, $ok, $detail = '') { $rows[] = [$label, $ok, $detail]; }

add($rows, 'PHP version', version_compare(PHP_VERSION, '7.4', '>='), PHP_VERSION . ' (needs 7.4 or newer)');
add($rows, 'mysqli extension', extension_loaded('mysqli'), extension_loaded('mysqli') ? 'loaded' : 'NOT loaded - enable extension=mysqli in php.ini');
add($rows, 'Sessions', session_status() === PHP_SESSION_ACTIVE,
    'visit #' . $_SESSION['check_visits'] . ' - refresh this page: the number must go up (if it stays 1, sessions are broken, and login cannot work)');
add($rows, 'Database connection', $conn !== null, $conn !== null ? "connected to '$db_name'" : $db_error);

$users = [];
if ($conn !== null) {
    try {
        $res = mysqli_query($conn, 'SELECT email, created_at FROM portal_users ORDER BY id DESC LIMIT 5');
        $count = mysqli_fetch_row(mysqli_query($conn, 'SELECT COUNT(*) FROM portal_users'))[0];
        add($rows, 'Table portal_users', true, "exists, $count registered user(s)");
        while ($r = mysqli_fetch_assoc($res)) { $users[] = $r; }
    } catch (mysqli_sql_exception $ex) {
        add($rows, 'Table portal_users', false, $ex->getMessage());
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Portal check</title>
<style>
 body{font-family:Arial,sans-serif;background:#0a0e17;color:#e2e8f0;padding:30px;max-width:800px;margin:auto}
 table{width:100%;border-collapse:collapse;margin-bottom:20px}
 td,th{padding:10px;border-bottom:1px solid #1e293b;text-align:left;vertical-align:top}
 .ok{color:#4ade80;font-weight:bold}.bad{color:#f87171;font-weight:bold}
 .note{color:#94a3b8;font-size:.9rem}
</style></head><body>
<h2>Portal setup check</h2>
<table>
<?php foreach ($rows as [$label, $ok, $detail]): ?>
  <tr><td><?= htmlspecialchars($label) ?></td>
      <td class="<?= $ok ? 'ok' : 'bad' ?>"><?= $ok ? 'OK' : 'PROBLEM' ?></td>
      <td><?= htmlspecialchars($detail) ?></td></tr>
<?php endforeach; ?>
</table>

<?php if ($users): ?>
<h3>Latest registered accounts</h3>
<table><tr><th>Email</th><th>Created</th></tr>
<?php foreach ($users as $u): ?>
  <tr><td><?= htmlspecialchars($u['email']) ?></td><td><?= htmlspecialchars($u['created_at']) ?></td></tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<p class="note">Delete check.php when everything works.</p>
</body></html>
