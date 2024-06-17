const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const session = require('express-session');
const path = require('path');
const app = express();
const port = 4000;

app.use(cors());
app.use(express.json());
app.use(session({
    secret: 'your_secret_key', // Replace with your own secret key
    resave: false,
    saveUninitialized: true,
    cookie: { secure: false } // Use true if using HTTPS
}));

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'ilrexho',
    password: 'nA)Aj9NQWix0[diC',
    database: 'albsale-vlora',
    port: 3306
});

connection.connect(error => {
    if (error) {
        console.error('Error connecting to the database:', error);
        return;
    }
    console.log("ILIRJAN REXHO is now connected to the database.");
});

app.get('/api/salt', (req, res) => {
    connection.query('SELECT * FROM salt', (err, results) => {
        if (err) {
            console.error('Error fetching data:', err);
            res.status(500).send('Error fetching data');
            return;
        }
        res.json(results);
    });
});

app.post('/login', (req, res) => {
    const { username, password } = req.body;
    const query = 'SELECT * FROM user WHERE username = ? AND password = ?';
    connection.query(query, [username, password], (err, results) => {
        if (err) {
            res.status(500).json({ error: 'Database error' });
        } else if (results.length > 0) {
            req.session.user = results[0]; // Save user info in session
            res.json({ success: true });
        } else {
            res.json({ success: false });
        }
    });
});

app.post('/register', (req, res) => {
    const { name, surname, ZINN, email, tel, username, password } = req.body;
    const query = 'INSERT INTO user (name, surname, ZINN, email, tel, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)';
    connection.query(query, [name, surname, ZINN, email, tel, username, password], (err) => {
        if (err) {
            console.error('Error during registration:', err);
            res.status(500).json({ error: 'Database error' });
        } else {
            res.json({ success: true });
        }
    });
});

app.get('/ProtectedPage', (req, res) => {
    if (req.session.user) {
        res.sendFile(path.join(__dirname, 'webapp', 'view', 'index.html', 'Protectedpage.view.xml'));
    } else {
        res.status(401).send('Unauthorized');
    }
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
