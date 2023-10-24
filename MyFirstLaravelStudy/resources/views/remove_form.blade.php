<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Remove</title>
</head>
<body>
    <form action="/remove" method="post">
        @method('delete')
        @csrf
        <select name="deleted_name">
            <option value="김민재">김민재</option>
            <option value="大谷">大谷</option>
            <option value="손흥민">손흥민</option>
            <option value="渡辺">渡辺</option>
            <option value="Kane">Kane</option>
            <option value="Ronaldo">Ronaldo</option>
            <option value="Messi">Messi</option>
        </select>
        <input type="submit" value="삭제">
    </form>
</body>
</html>