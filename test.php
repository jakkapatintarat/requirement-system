<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <form id="deleteForm" action="" method="post">
        <button type="submit" onclick="confirmDelete(event)">submit</button>
    </form>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์มโดยอัตโนมัติ

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // ส่งฟอร์มเมื่อยืนยันการลบ
                    document.getElementById("deleteForm").submit();
                }
            });
        }
    </script>
</body>

</html>