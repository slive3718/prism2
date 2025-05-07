var WordCounterHelper = (function () {
    function updateWordCount(textarea, wordCountDisplay) {
        let text = textarea.val().trim();

        // Match words using regex (splits on whitespace, filters out empty)
        let wordCount = text === '' ? 0 : text.split(/\s+/).length;

        wordCountDisplay.text('Word count: ' + wordCount);

        if (wordCount > 500) {
            wordCountDisplay.addClass('text-danger');
        } else {
            wordCountDisplay.removeClass('text-danger');
        }
    }

    function countTotalWords(wordCountSelectors, totalDisplay) {
        let totalWords = 0;

        wordCountSelectors.each(function () {
            let wordCount = parseInt($(this).text().replace(/\D+/g, ''), 10) || 0;
            totalWords += wordCount;
        });

        totalDisplay.html(totalWords);

        if (totalWords > 500) {
            totalDisplay.closest('div').addClass('text-danger').removeClass('text-success');
        } else {
            totalDisplay.closest('div').removeClass('text-danger').addClass('text-success');
        }
    }

    function runCounter(textareaSelector, wordCountSelector, totalWordCountSelector) {
        $(textareaSelector).off('input keydown').on('input keydown', function (event) {
            let textarea = $(this);
            let wordCountDisplay = textarea.siblings(wordCountSelector);

            if (event.type === 'input' || event.key === ' ') {
                updateWordCount(textarea, wordCountDisplay);
                countTotalWords($(wordCountSelector), $(totalWordCountSelector));
            }
        });
    }

    return {
        init: runCounter,
        updateWordCount: updateWordCount,
        countTotalWords: countTotalWords
    };
})();
