<!DOCTYPE html>
<html>
    <head>
        <title>Article Search</title>
    </head>
    <body>
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
                        @if(file_exists('/home/mibum/Desktop/DBWT2/Praktikum/abalo/app/articelimages/'.$article->id.'.jpg'))
                            <img src="{{ asset('/home/mibum/Desktop/DBWT2/Praktikum/abalo/app/articelimages/'.$article->id.'.jpg')}}" width="100" height="60">
                        @elseif(file_exists('/home/mibum/Desktop/DBWT2/Praktikum/abalo/app/articelimages/'.$article->id.'.png'))
                            <img src="{{ asset('/home/mibum/Desktop/DBWT2/Praktikum/abalo/app/articelimages/'.$article->id.'.png')}}" width="100" height="60">    
                        @else 
                            <p>No image availabel</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No article found.</p>
        @endif
    </body>
</html>