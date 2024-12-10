<?php
include APP_DIR.'views/templates/header.php';
?>
<?php
include APP_DIR.'views/templates/sidenav_admin.php';
?>
<main class="flex-1 overflow-y-auto p-8 ml-64">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">User Management</h1>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <table id="userTable" class="w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Birthday</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td class="px-4 py-2"><?= $user['firstname'] . ' ' . $user['lastname'] ?></td>
                        <td class="px-4 py-2"><?= $user['email'] ?></td>
                        <td class="px-4 py-2"><?= $user['contact_number'] ?></td>
                        <td class="px-4 py-2"><?= $user['birthday'] ?></td>
                        <td class="px-4 py-2"><?= $user['address'] ?></td>
                        <td class="px-4 py-2">
                            <button onclick="editUser(<?= $user['id'] ?>)" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded">
                                Edit
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Edit User Modal -->
    <div id="editUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Edit User</h3>
                <form id="editUserForm" class="space-y-4">
                    <input type="hidden" id="userId" name="userId">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="firstName" name="firstName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="lastName" name="lastName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="contactNumber" class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input type="text" id="contactNumber" name="contactNumber" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="birthday" class="block text-sm font-medium text-gray-700">Birthday</label>
                        <input type="date" id="birthday" name="birthday" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="address" name="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="button" onclick="closeEditModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- jQuery (necessary for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.tailwind.min.js"></script>

<script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "dom": '<"flex justify-between items-center mb-4"lf>rtip',
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries",
                },
                "drawCallback": function(settings) {
                    // Apply Tailwind classes to DataTables elements
                    $('.dataTables_length select, .dataTables_filter input').addClass('border border-gray-300 rounded-md text-gray-600 h-full py-0 pl-2 pr-7 bg-white hover:border-gray-400 focus:outline-none');
                    $('.dataTables_paginate .paginate_button').addClass('bg-white border border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 text-sm font-medium');
                    $('.dataTables_paginate .paginate_button.current').addClass('z-10 bg-blue-50 border-blue-500 text-blue-600');
                }
            });
        });

        function editUser(userId) {
            // Fetch user data and populate the form
            $.ajax({
                url: '<?= site_url("admin/get-user/") ?>' + userId,
                type: 'GET',
                success: function(response) {
                    console.log(response.data)
                    console.log(response.data.id)
                    var data = response.data;
                    $('#userId').val(data.id);
                    $('#firstName').val(data.firstname);
                    $('#lastName').val(data.lastname);
                    $('#email').val(data.email);
                    $('#contactNumber').val(data.contact_number);
                    $('#birthday').val(data.birthday);
                    $('#address').val(data.address);
                    $('#editUserModal').removeClass('hidden');
                },
                error: function() {
                    Swal.fire('Error', 'Failed to fetch user data', 'error');
                }
            });
        }

        function closeEditModal() {
            $('#editUserModal').addClass('hidden');
        }

        $('#editUserForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            // Add userId to the form data if it's not included already
            var userId = $('#userId').val();
            formData += '&userId=' + userId;  // Append userId to the serialized data
            $.ajax({
                url: '<?= site_url("admin/update-user/") ?>' + userId,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Success', 'User updated successfully', 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'Failed to update user', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'An error occurred while updating the user', 'error');
                }
            });
        });
    </script>
<?php
include APP_DIR.'views/templates/footer.php';
?>

