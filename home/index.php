<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description"
        content="An online crime management system that allows users to report and track criminal activities, ensuring effective monitoring and response by authorities for better public safety.">
    <meta name="keywords"
        content="crime management, online crime reporting, criminal activities, law enforcement, public safety, crime tracking, crime monitoring, crime database, crime reporting system, police management system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Online Crime Management System - Report and Track Criminal Activities">
    <meta property="og:description"
        content="An efficient platform for reporting and tracking crimes, designed to enhance public safety and enable law enforcement agencies to respond swiftly to criminal activities.">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <title>Online Crime Management System</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .slider {
            height: 60vh;
        }

        .slider-container {
            background-color: white;
            height: 60vh;
        }

        .slider-container .images {
            height: 400px;
        }

        .slider-container img {
            object-fit: cover;
            margin: 10px;
        }

        .hero-section-imgs#hero-img-center {
            animation: animate-center-image 3s infinite;
        }

        .hero-section-imgs.hero-imgs-muted {
            animation: animate-muted-images 3s infinite;
        }

        @keyframes animate-center-image {
            50% {
                width: 250px;
            }

            100% {
                width: 400px;
            }
        }

        @keyframes animate-muted-images {
            50% {
                width: 150px;
            }

            100% {
                width: 200px;
            }
        }

        .slider-container img.hero-imgs-muted {
            opacity: 0.6;
        }

        .slider-container img#hero-img-center {
            width: 400px;
            object-fit: cover;
            margin: 10px;
        }
    </style>


    <style>
        #webdev {
            display: flex;
            align-items: center;
            justify-content: space-around;
            background-color: #ffffff;
            padding: 30px;
            height: 500px;
            background-image: url('../../assets/images/webdev.png');
            background-position-x: center;
            background-position-y: bottom;
            background-size: 80%;
            background-repeat: no-repeat;
            position: relative;
            margin-top: 20px;
        }

        .course-overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            background-color: black;
            opacity: 0.1;
        }

        #webdev .info {
            z-index: 2;
            display: flex;
            flex-direction: column;
            margin-left: 10px;
        }

        #webdev .info h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #webdev .info p {
            font-size: 24px;
            margin-bottom: 10px;
        }

        #webdev .info span {
            color: red;
            font-size: 36px;
            margin-right: 10px;
        }

        #webdev .info del {
            margin-left: 10px;
        }

        #webdev .info button {
            border: none;
            outline: none;
            background-color: blue;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        #webdev .info button:hover {
            background-color: white;
            color: blue;
        }

        #webdev .tech {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 300px;
            margin-top: 10px;
        }
    </style>
</head>

<body class="bg-dark h-100">    
    <?php include "../header.php" ?>
    <main class="h-100">
        <section class="slider">
            <div class="slider-container d-flex justify-content-center align-items-center flex-column">
                <div class="text-center pt-3 poppins-black">Welcome to Online Crime Management System</div>
                <div class="images d-flex justify-content-center align-items-center mt-3">
                    <div class="d-flex overflow-hidden w-100 d-flex justify-content-evenly align-items-center">
                        <img class="hero-section-imgs hero-imgs-muted rounded" id="hero-img-left"
                            src="../assets/img/slider/01.jpg" alt="laptop1">
                        <img class="hero-section-imgs rounded" id="hero-img-center" src="../assets/img/slider/02.jpg"
                            alt="desktop">
                        <img class="hero-section-imgs hero-imgs-muted rounded" id="hero-img-right"
                            src="../assets/img/slider/03.jpeg" alt="laptop2">
                    </div>
                </div>
            </div>
        </section>
        <section class="our-report text-white">
            <div class="text-center">
                <h1 class="p-2">Our report</h1>
            </div>

            <section class="d-flex align-items-center justify-content-around position-relative">
                <div>
                    <img src="../assets/img/crime_report.png" alt="Crime Report" width="250px">
                </div>
                <div class="z-2 d-flex flex-column">
                    <h1 class="fs-1 fw-bold mb-2 text-center">Crime Report</h1>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="text-danger fs-2 me-2">34333</span>
                        <del>4544555</del>
                    </div>
                    <button class="btn btn-primary mb-3">View More</button>
                    <div class="tech d-flex justify-content-between" style="width: 300px;"></div>
                </div>
            </section>
        </section>
        <section class="our-team bg-white py-5">
            <div class="container">
                <h1 class="text-center mb-5">Our Team</h1>
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-4">
                        <div class="card testimonial-card text-center p-4">
                            <img id="testimonial-img-1" class="mx-auto mb-3" alt="...">
                            <p class="testimonial-quote" id="testimonial-message-1"></p>
                            <p class="testimonial-name" id="testimonial-name-1"></p>
                            <p class="testimonial-position" id="testimonial-position-1"></p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card testimonial-card text-center p-4">
                            <img id="testimonial-img-2" class="mx-auto mb-3" alt="...">
                            <p class="testimonial-quote" id="testimonial-message-2"></p>
                            <p class="testimonial-name" id="testimonial-name-2"></p>
                            <p class="testimonial-position" id="testimonial-position-2"></p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card testimonial-card text-center p-4">
                            <img id="testimonial-img-3" class="mx-auto mb-3" alt="...">
                            <p class="testimonial-quote" id="testimonial-message-3"></p>
                            <p class="testimonial-name" id="testimonial-name-3"></p>
                            <p class="testimonial-position" id="testimonial-position-3"></p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card testimonial-card text-center p-4">
                            <img id="testimonial-img-4" class="mx-auto mb-3" alt="...">
                            <p class="testimonial-quote" id="testimonial-message-4"></p>
                            <p class="testimonial-name" id="testimonial-name-4"></p>
                            <p class="testimonial-position" id="testimonial-position-4"></p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-dark mx-2" id="testimonial-btn-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path
                                d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                        </svg>
                    </button>
                    <button class="btn btn-dark mx-2" id="testimonial-btn-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path
                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </main>
    <?php include "../footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    // START
    // This script is writtern for changing the three images of the hero section of webpage...
    const heroImagesLinks = ['../assets/img/slider/01.jpg', '../assets/img/slider/02.jpg', '../assets/img/slider/03.jpeg'];
    let heroImgLeft = document.getElementById('hero-img-left');
    let heroImgCenter = document.getElementById('hero-img-center');
    let heroImgRight = document.getElementById('hero-img-right');
    let leftImg = 0, centerImg = 1, rightImg = 2;

    setInterval(() => {
        leftImg = (leftImg + 1) % 3;
        centerImg = (centerImg + 1) % 3;
        rightImg = (rightImg + 1) % 3;
        // switching the images...
        heroImgLeft.src = heroImagesLinks[leftImg];
        heroImgCenter.src = heroImagesLinks[centerImg];
        heroImgRight.src = heroImagesLinks[rightImg];

    }, 6000);
    // This script is writtern for changing the three images of the hero section of webpage...
    // END
</script>

<script>
    const testimonials = [
        {
            img: '../assets/img/our-team/1.jpeg',
            name: 'Sumit Rathor',
            position: 'Xyz',
            message: 'Hey, I am Sumit'
        },
        {
            img: '../assets/img/our-team/4.jpeg',
            name: 'Harshil Jain',
            position: 'Xyz',
            message: 'Hey, I am Harshil Jain'
        },
        {
            img: '../assets/img/our-team/2.jpeg',
            name: 'Sanskriti',
            position: 'Xyz',
            message: 'Hey, I am Sanskriti'
        },
        {
            img: '../assets/img/our-team/3.jpeg',
            name: 'Khushi',
            position: 'Xyz',
            message: 'Hey, I am Khushi'
        }
    ];

    let currentTestimonial = 0;

    function displayTestimonial(index) {
        for (let i = 0; i < 4; i++) {  // Assuming there are 4 testimonial cards
            let testimonialIndex = (i + index) % testimonials.length;
            let testimonial = testimonials[testimonialIndex];

            document.getElementById(`testimonial-img-${i + 1}`).src = testimonial.img;
            document.getElementById(`testimonial-message-${i + 1}`).innerText = `"${testimonial.message}"`;
            document.getElementById(`testimonial-name-${i + 1}`).innerText = testimonial.name;
            document.getElementById(`testimonial-position-${i + 1}`).innerText = testimonial.position;
        }
    }

    document.getElementById('testimonial-btn-right').addEventListener('click', () => {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        displayTestimonial(currentTestimonial);
    });

    document.getElementById('testimonial-btn-left').addEventListener('click', () => {
        if (currentTestimonial === 0) {
            currentTestimonial = testimonials.length - 1;
        } else {
            currentTestimonial -= 1;
        }
        displayTestimonial(currentTestimonial);
    });

    // Initial display
    displayTestimonial(currentTestimonial);

</script>