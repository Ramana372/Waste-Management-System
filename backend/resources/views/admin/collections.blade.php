
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waste Collection - Eco Waste</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }
        header {
            background: #4CAF50;
            color: white;
            padding: 20px 10px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        main {
            padding: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-size: 16px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-btn {
            background: #ff9800;
            color: white;
            border: none;
            padding: 8px 15px;
            margin-right: 5px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .action-btn:hover {
            background: #fb8c00;
        }
        .delete-btn {
            background: #f44336;
        }
        .delete-btn:hover {
            background: #d32f2f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Waste Collection Records</h1>
    </header>
    <main>
        <h2>Collection Details</h2>
        <table id="collectionTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Waste Type</th>
                    <th>Quantity (Kg)</th>
                    <th>Collected At</th>
                    <th>Collector</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample record -->
                <tr>
                    <td>1</td>
                    <td>Sector 21, Chandigarh</td>
                    <td>Plastic</td>
                    <td>50</td>
                    <td>2025-04-27</td>
                    <td>Ramesh Kumar</td>
                    
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>
