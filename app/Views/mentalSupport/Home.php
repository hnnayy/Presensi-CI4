<?= $this->extend('mentalSupport/layout.php') ?> 

<?= $this->section('content') ?>

<style>
    .segment-clock {
        font-size: 80px;
        font-weight: bold;
        color: #333;
        letter-spacing: 2px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        line-height: 1;
        margin-left: 20%
    }

    .time-part {
        margin: 5px 0;
    }

    .clock-text {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-left: 20px;
    }

    .day {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        color: #e74c3c;
        font-size: 10px;
        font-weight: bold;
        background: white;
        border: 1px solid grey;
        border-radius: 15px;
        padding: 5px;
    }

    .date {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        font-size: 20px;
        font-weight: bold;
        color: #000;
        margin-top: 10px;
    }

    .button-hnn {
        font-size: 18px;
        font-weight: bold;
        color: #000;
        margin-top: 10px;
        border: 1px solid grey;
        border-radius: 8px;
        padding: 30px;
        margin-left: 40px;
        background-color: white;
        cursor: pointer;
    }

    .button-hnn:hover{
        background-color:#1f6186;
        color:white;

    }

    .button-hnn-out {
        font-size: 18px;
        font-weight: bold;
        color: #000;
        margin-top: 10px;
        border: 1px solid grey;
        border-radius: 8px;
        padding: 30px;
        margin-left: 40px;
        background-color: white;
        cursor: pointer;
    }

    .button-hnn-out:hover{
        background-color:#841c2d;
        color:white;

    }

    .parent-clock {
        display: flex;
        align-items: center;
    }

    /* Manual card styling */
    .cardd {
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 0;
        margin-bottom: 20px;
        background-color: #fff;
        overflow: hidden;
    }

    .cardd:hover {
    transform: translateY(-5px) scale(0.8.02);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    z-index: 2;
    }

    .cardd-header {
        background-color: #1f6186;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        padding: 12px 16px;
        border-bottom: 1px solid #ccc;
        text-align:center;
    }

    .cardd-header-out {
        background-color: #841c2d;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        padding: 12px 16px;
        border-bottom: 1px solid #ccc;
        text-align:center;
    }

    .cardd-body {
        padding: 20px;
        background-color: #f8f9fa;
    }

    /* Grid layout simulasi bootstrap */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .col-md-2,
    .col-md-4 {
        padding: 0 10px;
    }

    .col-md-2 {
        flex: 0 0 16.6667%;
        max-width: 16.6667%;
    }

    .col-md-4 {
        flex: 0 0 33.3333%;
        max-width: 33.3333%;
    }

    @media (max-width: 768px) {
        .col-md-2, .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<div class="row">
    <div class="col-md-2">
        1
    </div>
    <div class="col-md-4">
        <div class="cardd">
            <div class="cardd-header">
                Presensi Masuk
            </div>
            <div class="cardd-body">
                <div class="parent-clock">
                    <div class="segment-clock">
                        <div class="time-part" id="jam-masuk">00:</div>
                        <div class="time-part" id="menit-masuk">00</div>
                    </div>

                    <div class="clock-text">
                        <div class="day" id="hari-masuk">WEDNESDAY</div>
                        <div class="date" id="tanggal-masuk">30, AUG</div>
                    </div>
                    <div>
                        <form>
                            <button class="button-hnn" type="submit">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="cardd">
            <div class="cardd-header-out">
                Presensi Keluar
            </div>
            <div class="cardd-body">
                <div class="parent-clock">
                    <div class="segment-clock">
                        <div class="time-part" id="jam-keluar">00:</div>
                        <div class="time-part" id="menit-keluar">00</div>
                    </div>

                    <div class="clock-text">
                        <div class="day" id="hari-keluar">WEDNESDAY</div>
                        <div class="date" id="tanggal-keluar">30, AUG</div>
                    </div>
                    <div>
                        <form>
                            <button class="button-hnn-out" type="submit">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        1
    </div>
</div>

<script>
    function updateClock(idPrefix) {
        const now = new Date();
        const jam = now.getHours();
        const menit = now.getMinutes();
        const tanggal = now.getDate();
        const bulan = now.toLocaleString('default', { month: 'short' }).toUpperCase();
        const hari = now.toLocaleString('default', { weekday: 'long' }).toUpperCase();

        document.getElementById(`jam-${idPrefix}`).textContent = (jam < 10 ? '0' + jam : jam) + ':';
        document.getElementById(`menit-${idPrefix}`).textContent = menit < 10 ? '0' + menit : menit;
        document.getElementById(`tanggal-${idPrefix}`).textContent = `${tanggal}, ${bulan}`;
        document.getElementById(`hari-${idPrefix}`).textContent = hari;
    }

    function updateAllClocks() {
        updateClock("masuk");
        updateClock("keluar");
    }

    setInterval(updateAllClocks, 1000);
    updateAllClocks();
</script>

<?= $this->endSection() ?>
