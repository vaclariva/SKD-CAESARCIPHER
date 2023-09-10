<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caesar Cipher</title> 
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 50px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 10px;
             font-size: 14px;
             max-width: 100px
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        p.result {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Caesar Cipher</h1>
        <form method="POST">
            <label for="text">Teks:</label>  <!-- buat judul dari halaman-->
            <!-- Input teks yang akan dienkripsi atau didekripsi -->
            <input type="text" id="text" name="text" required value="<?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?>" size="90">
            <!-- Tombol untuk mengirim form dengan tindakan "encrypt" -->
            <button type="submit" name="action" value="encrypt">Enkripsi</button>
            <!-- Tombol untuk mengirim form dengan tindakan "decrypt" -->
            <button type="submit" name="action" value="decrypt">Deskripsi</button>
        </form>
        <?php
        
        function caesarCipher($text, $shift, $action) {
            $result = ""; // Variabel untuk menyimpan teks hasil enkripsi atau dekripsi.
            $length = strlen($text); // Menghitung panjang teks input.
        
            for ($i = 0; $i < $length; $i++) {
                $char = $text[$i]; // Mengambil karakter pada posisi $i dalam teks.
        
                // Mengecek apakah karakter adalah huruf kecil (a-z).
                if ($char >= 'a' && $char <= 'z') {
                    if ($action === "encrypt") { // Jika tindakan adalah enkripsi.
                        // Mengenkripsi karakter dengan menggesernya sejauh $shift posisi dalam alfabet dan mengaturnya kembali ke alfabet kecil.
                        $newChar = chr(((ord($char) - ord('a') + $shift) % 26) + ord('a'));
                    } elseif ($action === "decrypt") { // Jika tindakan adalah dekripsi.
                        // Mendekripsi karakter dengan menggesernya ke belakang sejauh $shift posisi dalam alfabet dan mengaturnya kembali ke alfabet kecil.
                        $newChar = chr(((ord($char) - ord('a') - $shift + 26) % 26) + ord('a'));
                    } else {
                        // Jika tindakan bukan enkripsi atau dekripsi, karakter tetap tidak berubah.
                        $newChar = $char;
                    }
                }
                // Mengecek apakah karakter adalah huruf besar (A-Z).
                elseif ($char >= 'A' && $char <= 'Z') {
                    if ($action === "encrypt") { // Jika tindakan adalah enkripsi.
                        // Mengenkripsi karakter dengan menggesernya sejauh $shift posisi dalam alfabet besar dan mengaturnya kembali ke alfabet besar.
                        $newChar = chr(((ord($char) - ord('A') + $shift) % 26) + ord('A'));
                    } elseif ($action === "decrypt") { // Jika tindakan adalah dekripsi.
                        // Mendekripsi karakter dengan menggesernya ke belakang sejauh $shift posisi dalam alfabet besar dan mengaturnya kembali ke alfabet besar.
                        $newChar = chr(((ord($char) - ord('A') - $shift + 26) % 26) + ord('A'));
                    } else {
                        // Jika tindakan bukan enkripsi atau dekripsi, karakter tetap tidak berubah.
                        $newChar = $char;
                    }
                }
                // Mengecek apakah karakter adalah angka (0-9).
                elseif (ctype_digit($char)) {
                    if ($action === "encrypt") { // Jika tindakan adalah enkripsi.
                        // Mengenkripsi karakter dengan menggesernya sejauh $shift posisi dalam angka (0-9).
                        $newChar = chr(((ord($char) - ord('0') + $shift) % 10) + ord('0'));
                    } elseif ($action === "decrypt") { // Jika tindakan adalah dekripsi.
                        // Mendekripsi karakter dengan menggesernya ke belakang sejauh $shift posisi dalam angka (0-9).
                        $newChar = chr(((ord($char) - ord('0') - $shift + 10) % 10) + ord('0'));
                    }
                } else {
                    // Jika karakter bukan huruf atau angka, karakter tetap tidak berubah.
                    $newChar = $char;
                }
        
                // Menambahkan karakter yang telah dienkripsi atau didekripsi ke hasil akhir.
                $result .= $newChar;
            }
        
            // Mengembalikan teks hasil enkripsi atau dekripsi.
            return $result;
        }


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Mengambil teks yang diinputkan oleh pengguna dari form
            $text = $_POST["text"];
            
            // Mengambil tindakan yang dipilih oleh pengguna (encrypt atau decrypt) dari form
            $action = $_POST["action"];
            
            // Memanggil fungsi caesarCipher() untuk melakukan enkripsi atau dekripsi teks
            // dengan menggunakan teks, pergeseran 12, dan tindakan yang dipilih oleh pengguna
            $resultText = caesarCipher($text, 12, $action);
            
            // Menampilkan hasil enkripsi atau dekripsi di bawah form
            echo '<p class="result"><strong>Hasil:</strong> ' . $resultText . '</p>';
        }
        ?>
        
    </div>
</body>
</html>
