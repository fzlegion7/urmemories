<?php
// Menghubungkan ke database
include('db.php');

// Pagination: menampilkan 10 postingan pertama
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query untuk mengambil data postingan
$query = "SELECT * FROM posts ORDER BY timestamp DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

// Cek apakah query berhasil
if ($result === false) {
    die("Error: " . $conn->error);
}

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

// Ambil total jumlah postingan untuk menghitung pagination
$total_posts_query = "SELECT COUNT(*) AS total FROM posts";
$total_posts_result = $conn->query($total_posts_query);
$total_posts_row = $total_posts_result->fetch_assoc();
$total_posts = $total_posts_row['total'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeachSocial - Timeline</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling yang sudah Anda buat tetap dipertahankan di sini */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0d1117;
            color: #c9d1d9;
        }
        .container {
            display: flex;
            justify-content: center;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .timeline {
            flex-grow: 1;
            width: 100%;
            max-width: 900px;
            padding: 20px;
            margin-left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .post {
            background-color: #21262d;
            border-radius: 10px;
            margin-bottom: 25px;
            padding: 20px;
            width: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }
        .post:hover {
            transform: scale(1.02);
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        .profile-pic img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }
        .user-info {
            margin-left: 15px;
            text-align: left;
        }
        .user-info h3 {
            margin: 0;
            font-size: 16px;
            color: #ffffff;
        }
        .user-info p {
            margin: 0;
            font-size: 14px;
            color: #6a737d;
        }
        .post-body {
            margin-top: 15px;
            font-size: 16px;
            line-height: 1.5;
        }
        .post-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            border-top: 1px solid #2d353b;
            padding-top: 15px;
            align-items: center;
        }
        .post-footer button {
            background-color: transparent;
            border: none;
            color: #c9d1d9;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .post-footer button:hover i {
            color: #1DA1F2;
        }
        .comment-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #2d353b;
            display: none;
            width: 100%;
            box-sizing: border-box;
        }
        .comment-box {
            width: 100%;
            padding: 10px;
            background-color: #2d353b;
            border: none;
            border-radius: 20px;
            color: #c9d1d9;
            font-size: 14px;
            resize: none;
            height: 40px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .comment-box::placeholder {
            color: #6a737d;
        }
        .comment-list {
            margin-top: 15px;
            list-style: none;
            padding-left: 0;
        }
        .comment-list li {
            background-color: #2d353b;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        .navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(21, 26, 35, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 30px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        }
        .navbar-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .navbar-menu a {
            text-decoration: none;
            color: #ffffff;
            font-size: 24px;
            transition: color 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            border-radius: 50%;
            position: relative;
        }
        .navbar-menu a:hover {
            color: #1DA1F2;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="timeline">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <div class="post-header">
                        <div class="profile-pic">
                            <img src="profile1.jpg" alt="User 1">
                        </div>
                        <div class="user-info">
                            <h3>User <?= $post['user_id']; ?></h3>
                            <p><?= $post['timestamp']; ?></p>
                        </div>
                    </div>
                    <div class="post-body">
                        <p><?= $post['content']; ?></p>
                    </div>
                    <div class="post-footer">
                        <div class="left">
                            <button class="like-button"><i class="fas fa-heart"></i> <?= $post['likes']; ?></button>
                            <button class="comment-button" onclick="toggleCommentBox(<?= $post['post_id']; ?>)"><i class="fas fa-comment-alt"></i> <?= $post['comments']; ?></button>
                        </div>
                        <div class="right">
                            <button class="save-button"><i class="fas fa-bookmark"></i> <?= $post['saves']; ?></button>
                            <button class="share-button"><i class="fas fa-share-alt"></i> <?= $post['shares']; ?></button>
                        </div>
                    </div>

                    <!-- Menampilkan komentar -->
                    <div class="comment-section" id="comment-section-<?= $post['post_id']; ?>">
                        <?php
                        // Query untuk mengambil komentar terkait postingan ini
                        $comment_query = "SELECT * FROM comments WHERE post_id = " . $post['post_id'];
                        $comment_result = $conn->query($comment_query);

                        if ($comment_result && $comment_result->num_rows > 0) {
                            while ($comment = $comment_result->fetch_assoc()) {
                                echo "<ul class='comment-list'>";
                                echo "<li>" . $comment['comment_text'] . "</li>";
                                echo "</ul>";
                            }
                        } else {
                            echo "<p>Belum ada komentar.</p>";
                        }
                        ?>
                        <input type="text" class="comment-box" placeholder="Kirim komentar menarikmu!">
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Tombol untuk menampilkan 10 postingan lebih -->
            <?php if ($total_posts > ($page * 10)): ?>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="?page=<?= $page + 1 ?>" style="background-color: #1DA1F2; padding: 10px 20px; color: white; border-radius: 5px; text-decoration: none;">Lihat 10 Postingan Terbaru Lagi</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="navbar">
        <div class="navbar-menu">
            <a href="#" class="active">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="#">
                <i class="fas fa-search"></i>
                <span>Search</span>
            </a>
            <a href="#">
                <i class="fas fa-plus-circle"></i>
                <span>Create</span>
            </a>
            <a href="#">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </div>
    </div>

    <script>
        function toggleCommentBox(postId) {
            const commentSection = document.getElementById('comment-section-' + postId);
            commentSection.style.display = (commentSection.style.display === 'block') ? 'none' : 'block';
        }
    </script>

</body>
</html>
