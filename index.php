<?php
require_once 'TodoController.php';

// TodoController 인스턴스 생성
$controller = new TodoController();

// 폼 제출 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $content = $_POST['content'];
        $controller->insertTask($content);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $controller->deleteTask($id);
    } elseif(isset($_POST['update'])){
        $id = $_POST['id'];
        $updateContent = $_POST['updateContent'];
        $controller->updateTask($id , $updateContent);
    }
    header("Location: index.php");
    exit();
}

// 할 일 목록 가져오기
$tasks = $controller->getAllTasks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>TODO List</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<nav class="navigation">
        <h1 class="center">TODO List</h1>
    </nav>
    <!-- 할 일 추가 폼 -->
    <form method="post" class="center">
        <input type="text" name="content" placeholder="할 일 내용" required>
        <button type="submit" name="add">추가</button>
    </form>

    <!-- 할 일 목록 -->
    <ul class="center">
        <?php foreach ($tasks as $task) : ?>
            <li>
                <form method="post" style="display:inline;">
                    <input type="text" name="updateContent" value="<?php echo $task['content'] ?>">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit" name="delete">삭제</button>
                    <button type="submit" name="update">수정</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
