(function(){
    var factory = function (exports) {
        var lang = {
            name : "ru",
            description : "Открыть онлайн Markdown Editor.",
            tocTitle    : "Содержание",
            toolbar : {
                undo             : "Отменить(Ctrl+Z)",
                redo             : "Вернуть(Ctrl+Y)",
                bold             : "Жирный",
                del              : "Зачеркнутый",
                italic           : "Курсив",
                quote            : "Блок цитат",
                ucwords          : "Первые буквы слов преобразовать в верхний регистр",
                uppercase        : "Выбранный текст преобразовать в верхний регистр",
                lowercase        : "Выбранный текст преобразовать в нижний регистр",
                h1               : "Заголовок 1",
                h2               : "Заголовок 2",
                h3               : "Заголовок 3",
                h4               : "Заголовок 4",
                h5               : "Заголовок 5",
                h6               : "Заголовок 6",
                "list-ul"        : "Ненумерованный список",
                "list-ol"        : "Нумерованый список",
                hr               : "Горизонтальная линия",
                link             : "Ссылка",
                "reference-link" : "Референсная ссылка",
                image            : "Картинка",
                code             : "Код inline",
                "preformatted-text" : "Предварительно отформатированный текст / код блока (табл отступ)",
                "code-block"     : "Блок кода (Multi-языки)",
                table            : "Таблица",
                datetime         : "Время дня",
                emoji            : "Emoji",
                "html-entities"  : "HTML сущности",
                pagebreak        : "Разрыв страницы",
                watch            : "Отключить предпросмотр",
                unwatch          : "Предпросмотр",
                preview          : "HTML-превью (Press Shift + ESC exit)",
                fullscreen       : "Полный экран (Press ESC exit)",
                clear            : "Очистить",
                search           : "Поиск",
                help             : "Помощь",
                info             : "О " + exports.title
            },
            buttons : {
                enter  : "Ввести",
                cancel : "Отменить",
                close  : "Закрыть"
            },
            dialog : {
                link : {
                    title    : "Ссылка",
                    url      : "Адрес",
                    urlTitle : "Заглавие",
                    urlEmpty : "Ошибка: Пожалуйста заполните адресс ссылки."
                },
                referenceLink : {
                    title    : "Референсная ссылка",
                    name     : "Имя",
                    url      : "Адрес",
                    urlId    : "ID",
                    urlTitle : "Заглавие",
                    nameEmpty: "Ошибка: Референсное имя не может быть пустым.",
                    idEmpty  : "Ошибка: Пожалуйста заполните id референсное ссылки.",
                    urlEmpty : "Ошибка: Пожалуйста заполните ссылку."
                },
                image : {
                    title    : "Картинка",
                    url      : "Адресс",
                    link     : "Ссыдка",
                    alt      : "Заглавие",
                    uploadButton     : "Загрузить",
                    imageURLEmpty    : "Ошибка: ссылка картинки не может быть пустой.",
                    uploadFileEmpty  : "Ошибка: загрука картинки не может быть пустой!",
                    formatNotAllowed : "Ошибка: не тот формат файла:"
                },
                preformattedText : {
                    title             : "Вставка обычного Кода ",
                    emptyAlert        : "Ошибка: пожалуйста заполните блок кода."
                },
                codeBlock : {
                    title             : "Вставка Кода",
                    selectLabel       : "Языки программирования: ",
                    selectDefaultText : "выберите язык програмирования...",
                    otherLanguage     : "Другие Языки",
                    unselectedLanguageAlert : "Ошибка: выберите язык кода.",
                    codeEmptyAlert    : "Ошибка: заполните блок кода."
                },
                htmlEntities : {
                    title : "HTML сущности"
                },
                help : {
                    title : "Помощь"
                }
            }
        };

        exports.defaults.lang = lang;
    };

    // CommonJS/Node.js
    if (typeof require === "function" && typeof exports === "object" && typeof module === "object")
    {
        module.exports = factory;
    }
    else if (typeof define === "function")  // AMD/CMD/Sea.js
    {
        if (define.amd) { // for Require.js

            define(["editormd"], function(editormd) {
                factory(editormd);
            });

        } else { // for Sea.js
            define(function(require) {
                var editormd = require("../editormd");
                factory(editormd);
            });
        }
    }
    else
    {
        factory(window.editormd);
    }

})();