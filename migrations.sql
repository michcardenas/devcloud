
   Illuminate\Database\QueryException 

  SQLSTATE[HY000] [1045] Access denied for user 'devcloudit'@'194.30.31.208' (using password: YES) (Connection: mysql, SQL: select exists (select 1 from information_schema.tables where table_schema = schema() and table_name = 'migrations' and table_type in ('BASE TABLE', 'SYSTEM VERSIONED')) as `exists`)

  at vendor/laravel/framework/src/Illuminate/Database/Connection.php:823
    819▕                     $this->getName(), $query, $this->prepareBindings($bindings), $e
    820▕                 );
    821▕             }
    822▕ 
  ➜ 823▕             throw new QueryException(
    824▕                 $this->getName(), $query, $this->prepareBindings($bindings), $e
    825▕             );
    826▕         }
    827▕     }

      [2m+39 vendor frames [22m

  40  artisan:16
      Illuminate\Foundation\Application::handleCommand()

