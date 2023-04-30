<!DOCTYPE html>
<html>

<head>
    <title>articles</title>
    <script defer src="{{ asset('js/warenkorb.js') }}"></script>
</head>

<body>
    <div id="cart">
        <h2>Warenkorb</h2>
        <table id="bag-items"></table>
    </div>

    <h1>Article Search</h1>
    <form method="get">
        <lable for="search">Search Articles</label>
            <input type="text" id="search" name="search" value="{{ $searchTerm }}" require>
            <button type="submit">Search</button>
    </form>

    @if ($articles)
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Creator</th>
                <th>Created Date</th>
                <th>image</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>{{ $article->ab_name }}</td>
                <td>{{ $article->ab_price }}</td>
                <td>{{ $article->ab_description }}</td>
                <td>{{ $article->ab_creator_id }}</td>
                <td>{{ $article->ab_createdate }}</td>
                <td>
                    @if(file_exists('articelimages/'.$article->id.'.jpg'))
                    <img src="{{ asset('articelimages/'.$article->id.'.jpg') }}" width="120" height="80">
                    @elseif(file_exists('articelimages/'.$article->id.'.png'))
                    <img src="{{ asset('articelimages/'.$article->id.'.png') }}" width="120" height="80">
                    @else
                    <p>No image available</p>
                    @endif
                </td>
                <td><button class="add-to-bag" article_id="{{ $article->id }}" article_name="{{ $article->ab_name }}" article_preis="{{ $article->ab_price}}" >+</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No article found.</p>
    @endif
</body>

</html>