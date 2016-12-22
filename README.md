# php proxy pool

##description :
- use php
- curl
- [html-parser](https://github.com/bupt1987/html-parser/blob/master/README.md)


## current situation :
- kind of messy !!
- need to Refact
- last change curl proxy model has some problem (get proxy source is a little less just around 78)

##some feel :

- 2016.12.17 22:37
    - [last repository](https://github.com/NominationP/py_proxy) , I use python , but now i'm work for PHP, I have to use PHP to work as soon as know more about PHP . Full day , I use PHP to complete one class(get_proxy) from curl , simple-html-dom , PHP syn ... I fount that's too complicated than python (include ";","$","{}"... or not have beautifulsoup !!! ....)
- 2016.12.18 16:52
    - add check_proxy.php && run.php && flow graph
    - until now I understand ORM a little , class -- abstract -- ORM -- frame
    ```
    such as :
        class common        { function check()}  //common part

        // class source_proxy and good_proxy both to want to use check(), just a little diff , so extract common part to class common , than to invoke common

        class source_proxy  { function check() { common-->check() } }
        class good_proxy    { function check() { common-->check() } }
    ```

- 2016.12.19 20:35
    - pthread spend me all most one day , and nothing done ... my php Thread Safety is disabled .... i can't change it (until now...i want to cry ~.~)
    - 95% done . except thread and log(little)

- 2016.12.22 09:26
    - 12.20 pretty much done
    - 12.21 change curl use proxy model (get proxy source use proxy of generated before)


