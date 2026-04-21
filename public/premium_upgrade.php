<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php"); exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade to Premium - LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkout-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
        }

        .header p {
            margin: 0;
            color: #ddd;
            font-size: 14px;
        }

        .benefits {
            margin-bottom: 30px;
            font-size: 14px;
            color: #efefef;
        }

        .benefits ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .benefits ul li {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .benefits ul li::before {
            content: "✓";
            color: #00c6ff;
            font-weight: bold;
            margin-right: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #ccc;
        }

        .form-control {
            width: 100%;
            padding: 14px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #00c6ff;
            background: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 10px rgba(0, 198, 255, 0.3);
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .col {
            flex: 1;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 114, 255, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 114, 255, 0.6);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit.loading {
            background: #555;
            pointer-events: none;
            box-shadow: none;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #aaa;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="checkout-container">
        <div class="header">
            <h1>Premium Membership</h1>
            <p>$9.99 / month</p>
        </div>

        <div class="benefits">
            <ul>
                <li>Unlimited book borrowing</li>
                <li>Exclusive access to premium collections</li>
                <li>Zero late fees</li>
                <li>Priority support</li>
            </ul>
        </div>

        <form id="paymentForm">
            <div class="form-group">
                <label for="nameOnCard">Name on Card</label>
                <input type="text" id="nameOnCard" class="form-control" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" class="form-control" placeholder="0000 0000 0000 0000" maxlength="19" required>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label for="expiry">Expiry (MM/YY)</label>
                    <input type="text" id="expiry" class="form-control" placeholder="MM/YY" maxlength="5" required>
                </div>
                <div class="col form-group">
                    <label for="cvc">CVC</label>
                    <input type="text" id="cvc" class="form-control" placeholder="123" maxlength="4" required>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">Pay $9.99 Securely</button>
            <a href="student_dashboard.php" class="back-link">Cancel and return to dashboard</a>
        </form>
    </div>

    <script>
        // Simple formatter for card number
        const cardNumberInput = document.getElementById('cardNumber');
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = '';
            for(let i = 0; i < value.length; i++) {
                if(i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }
            e.target.value = formattedValue;
        });

        // Simple formatter for expiry date
        const expiryInput = document.getElementById('expiry');
        expiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            if(value.length > 2) {
                value = value.substring(0,2) + '/' + value.substring(2,4);
            }
            e.target.value = value;
        });

        document.getElementById('paymentForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const originalText = btn.innerHTML;
            
            // Simulate processing
            btn.classList.add('loading');
            btn.innerHTML = 'Processing...';

            try {
                // Mocking an actual payment delay
                await new Promise(resolve => setTimeout(resolve, 1500));

                const res = await fetch("api/student.php?action=upgrade", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" }
                });
                const data = await res.json();
                
                if (data.success) {
                    alert("Payment successful! Welcome to Premium Membership.");
                    window.location.href = "student_dashboard.php";
                } else {
                    alert(data.error || "Upgrade failed.");
                    btn.classList.remove('loading');
                    btn.innerHTML = originalText;
                }
            } catch (err) {
                alert("A network error occurred.");
                btn.classList.remove('loading');
                btn.innerHTML = originalText;
            }
        });
    </script>
</body>
</html>
