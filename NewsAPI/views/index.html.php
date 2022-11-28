<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles.css">

    <title>News API</title>

</head>
<body>
    <h1>
        News-paper
    </h1>

<h3>
    Enjoy to news API<br>
</h3>
<br><br>


<br><br>
<div style="text-align: center;">
    <div class="Links">


        <a href="/?search=politics"> Politics </a><br>
        <a href="/?search=wild animals"> Wild animals </a><br>
        <a href="/?search=active live"> Active live </a><br>
        <a href="/?search=Football championships">Football Championships </a><br>
    </div>

    <div class="form-div">
        <form class="search" action="/" method="get">
            <label>
                <input type="text" placeholder="search..." name="search">
            </label>
            <button type="submit">Search</button>
        </form>
    </div>

</div>

<br><br>
    <div class="container">

    {% for i in 0..10 %}
    <a href={{ article[i].getPicture() }} target="_blank"> <img src="{{ article[i].getPicture() }}" alt="_blanc"
                                                                width="300"> </a><br>
    <b> {{ article[i].getTitle() | escape }}</b><br>
    <p>{{ article[i].getDescription() | escape }} </p>
    <a href="{{ article[i].getUrl() }}" target="_blank">Link </a>
    <br><br>
    {% endfor %}
    </div>
</body>
</html>
