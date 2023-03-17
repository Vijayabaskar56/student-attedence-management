<?php

    $query = "Select * from tblAdmin where Id = ".$_SESSION['userId']."";
    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rows = $rs->fetch_assoc();
    $fullName = $rows['firstName']."".$rows['lastName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
      nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* flex-direction: row-reverse; */
    background-color: #333;
    color: #fff;
    padding: 0 20px;
  }
  
  .nav-heading {
    /* flex-grow: 25vw; */
    text-align: left;
    font-size: 1.5rem;
    font-weight: bold;
    width: 25vw;
  }
  
  .nav-right {
    display: flex;
    align-items:flex-start;
  }
  
  .nav-hamburger {
    width: 20px;
    height: 30px;
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
  }
  
  .nav-hamburger i {
    color: #fff;
    font-size: 1.5rem;
    position: absolute;
  }
  
  .nav-left {
    display: flex;
    text-align: right;
    /* flex-direction: row-reverse; */
    align-items: right;
  }
  

  .nav-search-icon {
    padding: 10px;
    cursor: pointer;
  }
  
  .nav-search-icon i {
    margin: 20px;
    background-color: blue;
    color: yellow;
    font-size: 1.5rem;
    position: relative;
  }
  
  .nav-search-bar {
    display: none;
  }
  
  .nav-search-icon:hover + .nav-search-bar {
    display: block;
  }
  
  .nav-search-bar form {
    display: flex;
    align-items: center;
  }
  
  .nav-search-bar input {
    padding: 10px;
    border: none;
    background-color: #444;
    color: #fff;
  }
  
  .nav-user {
    display: flex;
    align-items: center;
    padding: 0 10px;
  }

  div {
    border: #fff dotted 2px;
  }
  
  .nav-user-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
  }
  
  .nav-user-pic img {
    width: 100%;
    height: 100%;
  }
  
  .nav-user-name {
    padding: 0 10px;
    font-size: 1.2rem;
    font-weight: bold;
  }

.empty {
  display: flex;
  position: relative;
  align-items: flex-start;
  width: 30vw;
}

.navi {
    position: fixed;
    background-color: var(--clr-dark);
    color: var(--clr-light);
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 100;
    transform: translateX(100%);
    transition: transform 250ms cubic-bezier(.5, 0, .5, 1);
}

.nav-item {
    list-style: none;
    display: flex;
    height: 100%;
    flex-direction: column;
    justify-content: space-evenly;
    align-items: center;
    margin: 0%;
    padding: 0%;
}

.nav-link {
    color: inherit;
    font-weight: var(--fw-bold);
    font-size: var(--fs-h3);
    text-decoration: none;
}

.navi__link:hover {
    color: var(--clr-accent);
}

.navi-toggle {
    padding: .5em;
    background: transparent;
    border: 0;
    cursor: pointer;
    position: absolute;
    right: 1em ;
    top: 1em;
    z-index: 1000;
}

.navi-open .navi {
    transform: translateX(0);
}

.navi-open .navi-toggle {
    position: fixed;
}

.navi-open .hamburger {
    transform: rotate(.625turn);
}

.navi-open .hamburger::before {
    transform: rotate(90deg) translateX(-6px);
}

.navi-open .hamburger::after {
    opacity: 0;
}


.hamburger {
    display: block;
    position: relative;
}

.hamburger,
.hamburger::before,
.hamburger::after {
    background-color: var(--clr-accent);
    width: 2em;
    height: 3px;
    border-radius: 1em;
    transition: transform 250ms ease-in-out;
}

.hamburger::before,
.hamburger::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
}

.hamburger::before { top: 6px; }
.hamburger::after{ bottom: 6px;}
  
    </style>
</head>
<body>
  <header>
    <button class="nav-toggle" aria-label="toggle-navigation">
      <span class="hamburger"></span>
    </button>
  
      <div class="nav-heading">AMS</div>
      <!-- <div class="nav-hamburger">
        <i class="fa fa-bars"></i>
      </div> -->

      <div class="empty"></div>
      <div class="nav-left">
        <div class="nav-search-icon">
          <i class="fa fa-search"></i>
        </div>
        <div class="nav-search-bar">
          <form>
            <input  type="text" placeholder="Search...">
          </form>
        </div>
      </div>
        <div class="nav-user">
          <div class="nav-user-pic">
            <img src="../img/logo/attnlg.jpg">
          </div>
        <div class="nav-user-name">John Doe</div>
        </div>
    </nav>
  </header>
</body>
</html>