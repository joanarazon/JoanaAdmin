<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="/css/admin.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account Management</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="{{ route('admin') }}" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">DewyDoIt App</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="{{ route('admin') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Admin Dashboard</span>
                </a>
            </li>
            
            <li class="active">
                <a href="{{ route('accountmanagement') }}">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Account Management</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="{{ route('showLogin') }}" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <form action="#">
                <div class="form-input">
                </div>
            </form>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Account Management</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{ route('admin') }}">Admin Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="{{ route('accountmanagement') }}">Account Management</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Users Information</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Usertype</th>
                                <th>Phone Number</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($accounts as $account)
                    <tr id="account_{{ $account->id }}">
                        <td contenteditable="true">{{ $account->id }}</td>
                        <td contenteditable="true">{{ $account->username }}</td>
                        <td contenteditable="true">{{ $account->email }}</td>
                        <td contenteditable="true">{{ $account->password }}</td>
                        <td contenteditable="true">{{ $account->usertype }}</td>
                        <td contenteditable="true">{{ $account->phone }}</td>
                        <td>{{ $account->created_at}}</td>
                        <td>{{ $account->updated_at }}</td>
                        <td>
                            <!-- Update and Delete buttons -->
                            <button type="button" onclick="updateAccount({{ $account->id }})">Update</button>
                            <button type="button" onclick="deleteAccount({{ $account->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    
<script>
async function deleteAccount(id) {
  try {
    const response = await fetch(`/deleteAccount/${id}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    });

    if (response.ok) {
      const deletedData = await response.json();
      // Remove the table row from the frontend table
      const row = document.getElementById(`account_${id}`);
      row.parentNode.removeChild(row); 
      console.log('Account deleted:', deletedData);
    } else {
      console.error('Failed to delete account');
    }
  } catch (error) {
    console.error('Error:', error);
  }
}

// Initialize the user list on page load
document.addEventListener('DOMContentLoaded', () => {
    renderUsers();
    document.getElementById('addUserForm').addEventListener('submit', addUser);

    document.querySelectorAll('.status').forEach(select => {
        select.addEventListener('change', function() {
            this.classList.remove('completed', 'pending', 'process');
            this.classList.add(this.value);
        });

        // Trigger the change event on page load to set the initial class
        select.dispatchEvent(new Event('change'));
    });

    const switchMode = document.getElementById('switch-mode');
    const body = document.body;

    switchMode.addEventListener('change', () => {
        if (switchMode.checked) {
            body.classList.add('dark');
        } else {
            body.classList.remove('dark');
        }
    });

    // Trigger the change event on page load to set the initial mode
window.addEventListener('load', () => {
        switchMode.checked = localStorage.getItem('dark-mode') === 'true';
        switchMode.dispatchEvent(new Event('change'));
    });

    // Save mode preference to localStorage
    switchMode.addEventListener('change', () => {
        localStorage.setItem('dark-mode', switchMode.checked);
    });
});
async function updateAccount(id) {
  const row = document.getElementById(`account_${id}`);
  const cells = row.getElementsByTagName('td');

  const updatedAccount = {
    username: cells[1].innerText,
    email: cells[2].innerText,
    password: cells[3].innerText,
    usertype: cells[4].innerText,
    phone: cells[5].innerText,
    _token: '{{ csrf_token() }}'
  };

  try {
    const response = await fetch(`/updateAccount/${id}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify(updatedAccount)
    });

    if (response.ok) {
      const updatedData = await response.json();
      // Update the frontend table
      cells[1].innerText = updatedData.username;
      cells[2].innerText = updatedData.email;
      cells[3].innerText = updatedData.password;
      cells[4].innerText = updatedData.usertype;
      cells[5].innerText = updatedData.phone;
      console.log('Account updated:', updatedData);
    } else {
      console.error('Failed to update account');
    }
  } catch (error) {
    console.error('Error:', error);
  }
}
</script>
</body>
</html>