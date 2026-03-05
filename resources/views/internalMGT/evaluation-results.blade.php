@extends('')

<div class="eval-desc">Complete all 7 sections before January 31 to be included in the compensation restructuring review.</div>
                        <div class="progress-row">
                            <span>Completion</span>
                            <span class="progress-count">3 / 7 sections</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" id="eval-progress" style="width:0%"></div>
                        </div>
                    </div>
                    <div class="ratings-section">
                        <div class="ratings-label">Last Evaluation Scores</div>
                        @php $ratings=[['Quality of Work',80,'4.0'],['Timeliness',60,'3.0'],['Communication',100,'5.0'],['Initiative',80,'4.0'],['Team Attitude',80,'4.0'],['Output Volume',60,'3.0'],['Reliability',100,'5.0']]; @endphp
                        @foreach($ratings as [$name,$pct,$score])
                        <div class="rating-row">
                            <span class="rating-name">{{ $name }}</span>
                            <div class="rating-track"><div class="rating-fill" data-width="{{ $pct }}%"></div></div>
                            <span class="rating-score">{{ $score }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>