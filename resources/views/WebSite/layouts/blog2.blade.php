@extends('WebSite.layouts.master')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>مقالات الأخبار</title>
    </head>
    <section class="blog-page-section">
        <div class="auto-container">
            <h1 class="text-center">Latest News Articles</h1><br>
            <div class="row clearfix" id="articles-container">
                @if (!empty($articles))
                    @foreach ($articles->articles as $article)
                        <!-- Updated to use object access -->
                        <div class="col-lg-6 col-md-12 col-sm-12 article" style="display: none;">
                            <div class="news-block-two">
                                <div class="inner-box">
                                    <div class="image">
                                        <a href="{{ $article->url }}" target="_blank"><img src="images/resource/news-4.jpg"
                                                alt="" /></a>
                                    </div>
                                    <div class="lower-content">
                                        <div class="content">
                                            <ul class="post-info">
                                                <li><span
                                                        class="icon flaticon-chat-comment-oval-speech-bubble-with-text-lines"></span>
                                                    02</li>
                                                <li><span class="icon flaticon-heart"></span> 126</li>
                                            </ul>
                                            <h2>{{ $article->title }}</h2>
                                            <p>{{ $article->description }}</p>
                                            <p><a href="{{ $article->url }}" target="_blank">Read more</a></p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No articles found.</p>
                @endif
            </div>

            <!-- Styled Pagination -->
            <div class="styled-pagination text-center">
                <ul class="inner-container clearfix" id="pagination">
                    <!-- Pagination links will be dynamically generated here -->
                </ul>
            </div>
        </div>
    </section>
    <!-- End Portfolio Page Section -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const articles = Array.from(document.querySelectorAll('.article'));
            const itemsPerPage = 6; // Number of articles to display per page
            let currentPage = 1;

            function displayArticles(page) {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;

                // Hide all articles initially
                articles.forEach((article, index) => {
                    if (index >= start && index < end) {
                        article.style.display = 'block'; // Show articles for the current page
                    } else {
                        article.style.display = 'none'; // Hide articles not for this page
                    }
                });

                // Update pagination links
                updatePagination(Math.ceil(articles.length / itemsPerPage), page);
            }

            function updatePagination(totalPages, currentPage) {
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = ''; // Clear previous pagination

                const prevButton = document.createElement('li');
                prevButton.innerHTML =
                    `<a href="#" class="${currentPage === 1 ? 'disabled' : ''}" data-page="${currentPage - 1}">Prev</a>`;
                pagination.appendChild(prevButton);

                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('li');
                    pageButton.innerHTML =
                        `<a href="#" class="${currentPage === i ? 'active' : ''}" data-page="${i}">${i}</a>`;
                    pagination.appendChild(pageButton);
                }

                const nextButton = document.createElement('li');
                nextButton.innerHTML =
                    `<a href="#" class="${currentPage === totalPages ? 'disabled' : ''}" data-page="${currentPage + 1}">Next</a>`;
                pagination.appendChild(nextButton);
            }

            document.getElementById('pagination').addEventListener('click', function(e) {
                e.preventDefault();
                if (e.target.tagName === 'A') {
                    const page = parseInt(e.target.getAttribute('data-page'));
                    if (!isNaN(page)) {
                        currentPage = page;
                        displayArticles(currentPage);
                    }
                }
            });

            // Initial display of articles
            displayArticles(currentPage);
        });
    </script>

    <style>
        /* Flexbox styles for equal heights */
        .row {
            display: flex;
            /* Enable flexbox layout */
            flex-wrap: wrap;
            /* Allow wrapping for smaller screens */
        }

        .article {
            display: flex;
            /* Make article a flex container */
            margin-bottom: 20px;
            /* Space between articles */
        }

        .news-block-two {
            flex: 1;
            /* Allow the blocks to grow equally */
            display: flex;
            flex-direction: column;
            /* Stack content vertically */
            border: 1px solid #ddd;
            /* Optional: Add a border */
            padding: 15px;
            /* Optional: Add padding */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Optional: Add shadow */
            height: 100%;
            /* Make the height 100% */
        }

        .inner-box {
            flex: 1;
            /* Allow the inner box to grow and fill the height */
        }

        .styled-pagination {
            margin-top: 20px;
        }

        .styled-pagination ul {
            list-style: none;
            display: inline-flex;
            padding: 0;
        }

        .styled-pagination li {
            margin: 0 5px;
            /* Adjust spacing between pagination items */
        }

        .styled-pagination a {
            padding: 10px 15px;
            /* Adjust padding for larger clickable area */
            background: #f8f9fa;
            /* Light background for normal state */
            color: #007bff;
            /* Text color for links */
            text-decoration: none;
            border-radius: 5px;
            /* Rounded corners */
            transition: background 0.3s, color 0.3s;
            /* Smooth transition for hover effects */
            border: 1px solid transparent;
            /* Add border to maintain structure */
        }

        .styled-pagination a:hover {
            background: #007bff;
            /* Change background on hover */
            color: #fff;
            /* Change text color on hover */
            border: 1px solid #007bff;
            /* Optional: Border on hover */
        }

        .styled-pagination a.active {
            background: #007bff;
            /* Active page background */
            color: #fff;
            /* Active page text color */
            border: 1px solid #0056b3;
            /* Darker border for active page */
        }

        .styled-pagination a.disabled {
            background: #ccc;
            /* Background for disabled links */
            pointer-events: none;
            /* Prevent clicking on disabled links */
        }
    </style>


    </html>
@endsection
