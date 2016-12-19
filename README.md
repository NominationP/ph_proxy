# php proxy pool

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



##description :
- use php
- curl
- [html-parser](https://github.com/bupt1987/html-parser/blob/master/README.md)


## current situation :
- get proxy ip from two url

##problem :

- if this project not well in your computer (I JUST KIDDING) , call me
    - reson: html-parser , I think it's better than simple-html-dom , much faster ,and that project use [composer](https://getcomposer.org/) , and I push github project not .ignore the /simhtmldorn

