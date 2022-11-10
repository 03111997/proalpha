
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProAlpha</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <div class="brand"><a href="#">proALPHA</a></div>

        <nav>
            <ul>
                <li><a href="enregistrement">Registration</a></li>
                <li><a href="administration">Administration</a></li>
                
            </ul>
        </nav>
    </header>
    <br/>

    
    <div class="container">
        <h1 class="tabulation" style="color:#929292; font-size:40px;">Attendance management</h1></br></br>
        <h1 class="tabulation" style="color:#697f38; font-size:30px;">Day Office (<?= date("M")?>)</h1></br></br>


        <?= $content; ?>
    </div>
    
    
</body>
</html>
<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

html, body {
    font-family: "Montserrat", sans-serif;
    background-color: aliceblue;
}

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.1rem 5rem;
    background: linear-gradient(180deg, #697f38 0%, #697f38 100%);
}

.brand a {
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 600;
    color: #f9f9f9;
}

.tabulation { 
display: inline-block; 
margin-left: 40px; 
} 

ul {
    display: flex;
    flex-direction: row;
}

li {
    list-style-type: none;
    margin-left: 3rem;
}

li > a{
    text-decoration: none;
    color: #f9f9f9;
    font-size: 0.9rem;
    font-weight: 500;
}


li::after {
    content: '';
    width: 0rem;
    height: 0.15rem;
    background-color: #f9f9f9;
    display: block;
    border-radius: 0.2rem;
    margin: 0.2rem auto 0 auto;
    transition: all 0.3s ease-in-out;
}

li:hover::after {
    width: 2rem;
}
</style>