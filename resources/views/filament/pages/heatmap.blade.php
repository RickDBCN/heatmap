<x-filament::page>
    <style>
        #wrapper {
            position: absolute;
        }

        .heatmap {
            color: #FFFFFF;
            font-size: 26px;
            font-weight: bold;
            text-shadow: -1px -1px 1px #000, 1px 1px 1px #000;
            position: relative;
            z-index: 100;
            height: 100vw;
            width: 1200px;
        }

        .bgiframe {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            height: auto;
            width: auto;
        }

        .overlay {
            overflow: visible;
            pointer-events: none;
            background: none !important;
        }
    </style>

    <x-filament::button>SM >< MD</x-filament::button>
    <x-filament::button>MD >< LG</x-filament::button>
    <x-filament::button disabled>LG >< XL</x-filament::button>
    <x-filament::button>XL >< XXL</x-filament::button>

    <div id="wrapper" class="bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="heatmap overlay" id="heatmapContainer">
        </div>
        <div class="bgiframe">
            <iframe src="{{ $url }}" id="iframe" title="iFrame" height="1000"
                    width="1200" frameborder="0"></iframe>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setHeatmapData();
        });

        let resizeId;

        window.addEventListener('resize', (e) => {
            clearTimeout(resizeId);
            resizeId = setTimeout(setHeatmapData, 350);
        });

        function setHeatmapData() {
            window.heatmap.setData({
                max: 10,
                data: JSON.parse('@json($clicks)')
            });
        }

        let iframe = document
            .querySelector('#iframe')
        let heatmap = document.getElementById('heatmapContainer')
        iframe.addEventListener('load', e => {
            e.target.contentWindow.addEventListener('scroll', e => {
                let scroll = iframe.contentWindow.document.documentElement.scrollTop;
                heatmap.style.transform = `translateY(${-scroll}px)`;
                // console.log(scroll)
            });
        });
    </script>
</x-filament::page>
