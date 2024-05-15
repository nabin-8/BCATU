<?php
require_once 'C:/laragon/www/completeprojectbcatu/config/pdo_connection.php';
require_once 'C:/laragon/www/completeprojectbcatu/config/helpers.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes | Syllabus</title>
    <link rel="stylesheet" href="../../../assets/css/syllabus/syllabus.css">
    <link rel="stylesheet" href="../../../assets/css/header/header.css">
    <link rel="stylesheet" href="../../../assets/css/footer/footer.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include 'C:/laragon/www/completeprojectbcatu/include/header/Header.php'; ?>
    <!-- top navbar end -->

    <!-- main section -->
    <section class="syllabus-container">
        <div class="syllabus-title">
            <h2>Bachelor of Computer Application Syllabus</h2>
            <p>
                Explore the Bachelor of Computer Application Syllabus with comprehensive details provided below. Each semester's coursework is meticulously outlined, featuring the course code, credit hours, and corresponding titles. Spanning over four years, the BCA program encompasses a total of 126 credit hours, a culmination of rigorous academic pursuit.
                <br><br>
                In understanding the workload, it's crucial to note that each credit hour translates to 16 lecture hours. Thus, the journey to completing BCA encompasses a grand total of 2016 lecture hours, a testament to the depth and breadth of knowledge to be acquired.
                Of the 126 credit hours, 96 are devoted exclusively to computer-related subjects, encompassing core courses, electives, and invaluable internships. This emphasis underscores the program's commitment to furnishing students with a robust foundation and practical experience in the dynamic realm of computer science.
            </p>
        </div>

        <div class="syllabus-table-content-wraper">
            <div id="table-contents-main">
                <table class="table-content">
                    <tbody>
                        <tr>
                            <td class="table-semester-top-css" colspan="7">1st Semester</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit Hrs.</td>
                            <td>Lecture Hrs.</td>
                            <td>Tutorial Hrs.</td>
                            <td>Lab Hrs.</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>CACS101</td>
                            <td>Computer Fundamentals & Applications</td>
                            <td>4</td>
                            <td>4</td>
                            <td>-</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CACO102</td>
                            <td>Society and Technology</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>CAEN103</td>
                            <td>English I</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>CAMT104</td>
                            <td>Mathematics I</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>CACS105</td>
                            <td>Digital Logic</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>16</td>
                            <td>16</td>
                            <td>2</td>
                            <td>7</td>
                        </tr>
                    </tbody>
                </table>
                <!-- for second semester -->
                <table class="table-content">
                    <tbody>
                        <tr>
                            <td class="table-semester-top-css" colspan="7">2nd Semester</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit Hrs.</td>
                            <td>Lecture Hrs.</td>
                            <td>Tutorial Hrs.</td>
                            <td>Lab Hrs.</td>
                        </tr>
                        <!-- Semester II content -->
                        <tr>
                            <td>1</td>
                            <td>CACS151</td>
                            <td>C Programming</td>
                            <td>4</td>
                            <td>4</td>
                            <td>1</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CAAC152</td>
                            <td>Financial Accounting</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>CAEN153</td>
                            <td>English II</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>CAMT154</td>
                            <td>Mathematics II</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>CACS155</td>
                            <td>Microprocessor and Computer Architecture</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>16</td>
                            <td>16</td>
                            <td>5</td>
                            <td>7</td>
                        </tr>
                    </tbody>
                </table>

                <!-- for third sem -->
                <table class="table-content">
                    <tbody>
                        <tr>
                            <td class="table-semester-top-css" colspan="7">3rd Semester</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit Hrs.</td>
                            <td>Lecture Hrs.</td>
                            <td>Tutorial Hrs.</td>
                            <td>Lab Hrs.</td>
                        </tr>
                        <!-- Semester III content -->
                        <tr>
                            <td>1</td>
                            <td>CACS201</td>
                            <td>Data Structures and Algorithms</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CAST202</td>
                            <td>Probability and Statistics</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>CACS203</td>
                            <td>System Analysis and Design</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>CACS204</td>
                            <td>OOP in Java</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>CACS205</td>
                            <td>Web Technology</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>15</td>
                            <td>15</td>
                            <td>3</td>
                            <td>9</td>
                        </tr>
                    </tbody>
                </table>

                <!-- for 4th sem -->
                <table class="table-content">
                    <tbody>
                        <tr>
                            <td class="table-semester-top-css" colspan="7">4th Semester</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit Hrs.</td>
                            <td>Lecture Hrs.</td>
                            <td>Tutorial Hrs.</td>
                            <td>Lab Hrs.</td>
                        </tr>
                        <!-- Semester IV content -->
                        <tr>
                            <td>1</td>
                            <td>CACS251</td>
                            <td>Operating System</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CACS252</td>
                            <td>Numerical Methods</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>CACS253</td>
                            <td>Software Engineering</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>CACS254</td>
                            <td>Scripting Language</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>CACS255</td>
                            <td>Database Management System</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>CAPJ256</td>
                            <td>Project I</td>
                            <td>2</td>
                            <td>-</td>
                            <td>-</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>17</td>
                            <td>15</td>
                            <td>4</td>
                            <td>13</td>
                        </tr>
                    </tbody>
                </table>

                <!-- 5th sem -->
                <table class="table-content">
                    <tbody>
                        <tr>
                            <td class="table-semester-top-css" colspan="7">5th Semester</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit Hrs.</td>
                            <td>Lecture Hrs.</td>
                            <td>Tutorial Hrs.</td>
                            <td>Lab Hrs.</td>
                        </tr>
                        <!-- Semester V content -->
                        <tr>
                            <td>1</td>
                            <td>CACS301</td>
                            <td>MIS and E-Business</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CACS302</td>
                            <td>DotNet Technology</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>CACS303</td>
                            <td>Computer Networking</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>CAMG304</td>
                            <td>Introduction to Management</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>CACS305</td>
                            <td>Computer Graphics and Animation</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>15</td>
                            <td>15</td>
                            <td>2</td>
                            <td>9</td>
                        </tr>
                    </tbody>
                </table>

                <!-- 6th sem -->
                <table class="table-content">
                    <tbody>
                        <tr>
                            <td class="table-semester-top-css" colspan="7">6th Semester</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit Hrs.</td>
                            <td>Lecture Hrs.</td>
                            <td>Tutorial Hrs.</td>
                            <td>Lab Hrs.</td>
                        </tr>
                        <!-- Semester VI content -->
                        <tr>
                            <td>1</td>
                            <td>CACS351</td>
                            <td>Mobile Programming</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CACS352</td>
                            <td>Distributed System</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>CAEC353</td>
                            <td>Applied Economics</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>CACS354</td>
                            <td>Advanced Java Programming</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>CACS355</td>
                            <td>Network Programming</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>CAPJ356</td>
                            <td>Project II</td>
                            <td>2</td>
                            <td>-</td>
                            <td>-</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>17</td>
                            <td>15</td>
                            <td>2</td>
                            <td>12</td>
                        </tr>
                    </tbody>
                </table>

                <!-- 7th sem -->
                <table class="table-content">
                    <tbody>
                        <tr>
                            <td class="table-semester-top-css" colspan="7">7th Semester</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit Hrs.</td>
                            <td>Lecture Hrs.</td>
                            <td>Tutorial Hrs.</td>
                            <td>Lab Hrs.</td>
                        </tr>
                        <!-- Semester VII content -->
                        <tr>
                            <td>1</td>
                            <td>CACS401</td>
                            <td>Cyber Law and Professional Ethics</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CACS402</td>
                            <td>Cloud Computing</td>
                            <td>3</td>
                            <td>3</td>
                            <td>-</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>CAIN403</td>
                            <td>Internship</td>
                            <td>3</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Elective I</td>
                            <td colspan="7">
                                <!-- List of Elective Subjects for BCA VII Semester -->
                                <table>
                                    <tr>
                                        <td>S.no.</td>
                                        <td>Course Code</td>
                                        <td>Course Title</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>CACS404</td>
                                        <td colspan="3">Image Processing</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>CACS405</td>
                                        <td>Database Administration</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>CACS406</td>
                                        <td>Network Administration</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>CACS408</td>
                                        <td>Advanced Dot Net Technology</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>CACS409</td>
                                        <td>E-Governance</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>CACS410</td>
                                        <td>Artificial Intelligence</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>15</td>
                            <td>12</td>
                            <td>1</td>
                            <td>3</td>
                        </tr>
                    </tbody>
                </table>

                <!-- 8th -->
                <table class="table-content">
                    <tbody>
                        <tr>
                            <td class="table-semester-top-css" colspan="7">8th Semester</td>
                        </tr>
                        <tr>
                            <td>SN</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit Hrs.</td>
                            <td>Lecture Hrs.</td>
                            <td>Tutorial Hrs.</td>
                            <td>Lab Hrs.</td>
                        </tr>
                        <!-- Semester VIII content -->
                        <tr>
                            <td>1</td>
                            <td>CAOR451</td>
                            <td>Operations Research</td>
                            <td>3</td>
                            <td>3</td>
                            <td>1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CAPJ452</td>
                            <td>Project III</td>
                            <td>6</td>
                            <td>-</td>
                            <td>-</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Elective III</td>
                            <td colspan="5">
                                <!-- List of Elective Subjects for BCA VIII Semester -->
                                <table>
                                    <tr>
                                        <td>S.no.</td>
                                        <td>Course Code</td>
                                        <td>Course Title</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>CACS453</td>
                                        <td>Database Programming</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>CACS454</td>
                                        <td>Geographical Information System</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>CACS455</td>
                                        <td>Data Analysis and Visualization</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>CACS456</td>
                                        <td>Machine Learning</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>CACS457</td>
                                        <td>Multimedia System</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>CACS458</td>
                                        <td>Knowledge Engineering</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>CACS459</td>
                                        <td>Information Security</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>CACS460</td>
                                        <td>Internet of Things</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>15</td>
                            <td>9</td>
                            <td>1</td>
                            <td>12</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- main section -->

    <!-- footer -->
    <?php include 'C:/laragon/www/completeprojectbcatu/include/footer/Footer.php'; ?>
</body>

</html>