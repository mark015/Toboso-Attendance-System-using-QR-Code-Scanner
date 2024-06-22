<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Time Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 800px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="time"] {
            width: 100px;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .day {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Monthly Time Record</h2>
    <form id="monthlyTimeRecord">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="month">Month:</label>
        <input type="month" id="month" name="month" required>
        <div id="days"></div>
        <input type="submit" value="Submit">
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('monthlyTimeRecord');
            const daysDiv = document.getElementById('days');
            const monthInput = document.getElementById('month');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(form);
                const data = {};
                for (const [key, value] of formData.entries()) {
                    data[key] = value;
                }
                console.log(data);
                // You can now send the data to your server or process it further
            });

            monthInput.addEventListener('change', function() {
                const date = new Date(monthInput.value);
                const daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
                daysDiv.innerHTML = '';
                for (let i = 1; i <= daysInMonth; i++) {
                    const dayDiv = document.createElement('div');
                    dayDiv.classList.add('day');
                    const label = document.createElement('label');
                    label.textContent = `Day ${i}:`;
                    const timeInInput = document.createElement('input');
                    timeInInput.type = 'time';
                    timeInInput.name = `day_${i}_timeIn`;
                    timeInInput.required = true;
                    const timeOutInput = document.createElement('input');
                    timeOutInput.type = 'time';
                    timeOutInput.name = `day_${i}_timeOut`;
                    timeOutInput.required = true;
                    dayDiv.appendChild(label);
                    dayDiv.appendChild(timeInInput);
                    dayDiv.appendChild(timeOutInput);
                    daysDiv.appendChild(dayDiv);
                }
            });
        });
    </script>
</body>
</html>
