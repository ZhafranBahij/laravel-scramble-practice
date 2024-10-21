# Scramble Dedoc

![image.png](ImgMarkdown/image.png)

[https://scramble.dedoc.co/](https://scramble.dedoc.co/)

## Step by Step

### Install Anything

- Install Laravel
    
    ```bash
    composer global require laravel/installer
    
    laravel new example-app
    ```
    
    ![image.png](ImgMarkdown/image%201.png)
    
    Fyi:
    
    - I choose none starter kit because I don’t need this for now.
    - Using Pest for testing framework, I think it’s good.
    
    ![Using sqlite because lazy to create new DB in mysql](ImgMarkdown/image%202.png)
    
    Using sqlite because lazy to create new DB in mysql
    
    ![Done](ImgMarkdown/image%203.png)
    
    Done
    
    ![image.png](ImgMarkdown/image%204.png)
    
- Install Dedoc Scramble
    
    ```bash
    composer require dedoc/scramble
    ```
    
    ![image.png](ImgMarkdown/image%205.png)
    
    After install, you can open this
    
    ![image.png](ImgMarkdown/image%206.png)
    
- Install API
    
    In Laravel 11, you must install api first. But, you’ll automatically install Laravel Sanctum after install api.
    
    ```bash
    php artisan install:api
    ```
    
    ![image.png](ImgMarkdown/image%207.png)
    
    ![image.png](ImgMarkdown/image%208.png)
    

### CRUD Product API

This step can be 

### Example

- Index
    
    ```php
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $books = Book::query()
            ->get();
    
            return response()->json([
                'status_code' => 200,
                'message' => 'Get all book',
                'data' => $books,
            ]);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => $th->getStatusCode(),
                'message' => $th->getMessage(),
                'data' => $th->getMessage(),
            ]);
        }
    }
    ```
    
    ![image.png](ImgMarkdown/image%209.png)
    
    ![image.png](ImgMarkdown/image%2010.png)
    
- Show
    
    ```php
    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'message' => 'Get book',
                'data' => $book,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => $th->getStatusCode(),
                'message' => $th->getMessage(),
                'data' => $th->getMessage(),
            ]);
        }
    }
    ```
    
    ![image.png](ImgMarkdown/image%2011.png)
    
    ![image.png](ImgMarkdown/image%2012.png)
    
    ![image.png](ImgMarkdown/image%2013.png)
    
- Delete
    
    ```php
      /**
       * Remove the specified resource from storage.
       */
      public function destroy(Book $book)
      {
          try {
              $book->delete();
              return response()->json([
                  'status_code' => 200,
                  'message' => 'Delete book',
              ]);
          } catch (\Throwable $th) {
              return response()->json([
                  'status_code' => $th->getStatusCode(),
                  'message' => $th->getMessage(),
              ]);
          }
      }
    ```
    
    ![image.png](ImgMarkdown/image%2014.png)
    
- Create
    
    ![image.png](ImgMarkdown/image%2015.png)
    
    ![image.png](ImgMarkdown/image%2016.png)
    
    ![image.png](ImgMarkdown/image%2017.png)
    
- Update
    
    ```php
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            $book->update($request->validated());
    
            return response()->json([
                'status_code' => 200,
                'message' => 'Successfully update data!',
                'data' => $book,
            ]);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => $th->getStatusCode(),
                'message' => $th->getMessage(),
                'data' => $th->getMessage(),
            ]);
        }
    }
    ```
    
    ![image.png](ImgMarkdown/image%2018.png)
    
    ![image.png](ImgMarkdown/image%2019.png)
    

### Using Sanctum

[https://laravel.com/docs/11.x/sanctum#issuing-mobile-api-tokens](https://laravel.com/docs/11.x/sanctum#issuing-mobile-api-tokens)

```php
/**
 * Login via API
 */
public function login (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    // return $user;

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken(now()->toTimeString())->plainTextToken;
}
```

![image.png](ImgMarkdown/image%2020.png)

![image.png](ImgMarkdown/image%2021.png)

![If failed](ImgMarkdown/image%2022.png)

If failed

### Using Security Sanctum in Scramble Dedoc

```php
/**
 * Bootstrap any application services.
 */
public function boot(): void
{
    Scramble::afterOpenApiGenerated(function (OpenApi $openApi) {
        $openApi->secure(
            SecurityScheme::http('bearer')
        );
    });
}
```

![Example using bearer token](ImgMarkdown/image%2023.png)

Example using bearer token

![If didn’t use bearer token](ImgMarkdown/image%2024.png)

If didn’t use bearer token
