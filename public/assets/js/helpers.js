var WordCounterHelper = (function () {
    // Default configuration
    const defaultConfig = {
        wordLimit: 500,
        wordCountText: 'Word count: ',
        exceedClass: 'text-danger',
        withinLimitClass: 'text-success'
    };

    function updateWordCount(textarea, wordCountDisplay, config) {
        let text = textarea.val().trim();
        let wordCount = text === '' ? 0 : text.split(/\s+/).length;

        wordCountDisplay.text(config.wordCountText + wordCount);

        if (wordCount > config.wordLimit) {
            wordCountDisplay.addClass(config.exceedClass);
        } else {
            wordCountDisplay.removeClass(config.exceedClass);
        }
    }

    function countTotalWords(wordCountSelectors, totalDisplay, config) {
        let totalWords = 0;

        wordCountSelectors.each(function () {
            let wordCount = parseInt($(this).text().replace(/\D+/g, ''), 10) || 0;
            totalWords += wordCount;
        });

        totalDisplay.html(totalWords);
        const container = totalDisplay.closest('div');

        if (totalWords > config.wordLimit) {
            container.addClass(config.exceedClass).removeClass(config.withinLimitClass);
        } else {
            container.removeClass(config.exceedClass).addClass(config.withinLimitClass);
        }
    }

    function runCounter(textareaSelector, wordCountSelector, totalWordCountSelector, customConfig = {}) {
        // Merge custom config with defaults
        const config = {...defaultConfig, ...customConfig};

        $(textareaSelector).off('input keydown').on('input keydown', function (event) {
            let textarea = $(this);
            let wordCountDisplay = textarea.siblings(wordCountSelector);

            if (event.type === 'input' || event.key === ' ') {
                updateWordCount(textarea, wordCountDisplay, config);
                countTotalWords($(wordCountSelector), $(totalWordCountSelector), config);
            }
        });

        // Initialize counts on page load
        $(textareaSelector).each(function() {
            updateWordCount($(this), $(this).siblings(wordCountSelector), config);
        });
        countTotalWords($(wordCountSelector), $(totalWordCountSelector), config);
    }

    return {
        init: runCounter,
        updateWordCount: updateWordCount,
        countTotalWords: countTotalWords,
        config: defaultConfig
    };
})();